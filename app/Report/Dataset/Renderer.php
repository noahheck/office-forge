<?php


namespace App\Report\Dataset;


use App\File\FormField\Value;
use App\Form\DataMapper;
use App\FormDoc\Field as FormDocField;
use App\Report\Dataset;
use App\User;
use Carbon\Carbon;

class Renderer
{
    /**
     * @var Value
     */
    private $valueModel;

    /**
     * @var FormDocField
     */
    private $formDocFieldModel;

    /**
     * @var DataMapper
     */
    private $dataMapper;

    private $userGeneratingReport;
    private $userId;
    private $date;
    private $date_from;
    private $date_to;

    public function __construct(Value $valueModel, FormDocField $formDocFieldModel, DataMapper $dataMapper)
    {
        $this->valueModel = $valueModel;
        $this->formDocFieldModel = $formDocFieldModel;
        $this->dataMapper = $dataMapper;
    }

    public function setReportOptions(User $userGeneratingReport, $userId, $date, $date_from, $date_to)
    {
        $this->userGeneratingReport = $userGeneratingReport;

        $this->userId = $userId;
        $this->date = $date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    public function headers(Dataset $dataset)
    {
        $headers = [
            $dataset->datasetable->name
        ];

        foreach ($dataset->fields as $field) {
            $headers[] = $field->label;
        }

        return $headers;
    }

    /**
     * @param Dataset $dataset
     * @return \Generator
     */
    public function records(Dataset $dataset)
    {
        $datasetable = $dataset->datasetable;

        $fieldValueRelationshipIdentifier = $datasetable->instanceFieldValueRelationshipIdentifier();
        $fieldValueFieldIdentifier = $datasetable->instanceFieldValueFieldIdentifier();

        $fieldRecordIdentifier = $datasetable->instanceFieldRecordIdentifier();

        $instancesQueryBuilder = $datasetable->datasetableInstances();

        $dataset->load('fields');

        if ($dataset->isFileType()) {

            $dataset->load('fields.field');
        }

        // Apply non-numeric field filters to dataset here, then get instances
        foreach ($dataset->instanceAttributeFilters() as $filter) {

            $valueColumn = $this->getAttributeValueColumn($filter);

            if (in_array($valueColumn, ['created_at'])) {

                $instancesQueryBuilder->whereBetween($valueColumn, $this->queryValue($filter));
            } elseif (in_array($valueColumn, ['date'])) {

                $instancesQueryBuilder->whereBetween($valueColumn, $this->queryValue($filter));
            } else {

                $instancesQueryBuilder->where($valueColumn, $this->queryOperator($filter), $this->queryValue($filter));
            }

        }

        $instances = $instancesQueryBuilder->get();

        $instanceIds = $instances->pluck('id');

        if (!$instanceIds->count()) {

            return [];
        }

        foreach ($dataset->instanceFormFilters() as $filter) {


            if ($dataset->isFileType()) {

                $formField = \App\FileType\Form\Field::find($filter->field_id);

                $valueColumn = $this->dataMapper->getFieldValueColumn($formField);

                $queryBuilder = $this->valueModel
                    ->where('file_type_form_field_id', $filter->field_id);

            } elseif ($dataset->isFormDocTemplate()) {

                $formField = \App\FormDoc\Template\Field::find($filter->field_id);

                $valueColumn = $this->dataMapper->getFieldValueColumn($formField);

                $queryBuilder = $this->formDocFieldModel
                    ->where('form_doc_template_field_id', $filter->field_id);

            }




            if ($filter->operator === Filter::FILTER_OPERATOR_BETWEEN) {
                $queryBuilder->whereBetween($valueColumn, $this->queryValue($filter));
            } else {

                // The not-checked filter needs to include a check for NULL column value because of, well, reasons
                // In mysql, NULL doesn't != 1, so we get false negatives (it also doesn't != 0, so, there's that)
                if ($filter->operator === Filter::FILTER_OPERATOR_NOT_CHECKED) {

                    $queryBuilder->where(function($query) use ($valueColumn, $filter) {
                        $query->where($valueColumn, $this->queryOperator($filter), $this->queryValue($filter))
                            ->orWhereNull($valueColumn);
                    });

                } else {

                    $queryBuilder->where($valueColumn, $this->queryOperator($filter), $this->queryValue($filter));
                }
            }

            $queryBuilder->whereIn($fieldRecordIdentifier, $instanceIds);

            $results = $queryBuilder->get();

            $instanceIds = $results->pluck($fieldRecordIdentifier);
        }





        $instances = $datasetable->datasetableInstances()->find($instanceIds);

        $instances->load($fieldValueRelationshipIdentifier);


        foreach ($instances as $record) {
            $columns = [$record->name];


            foreach ($dataset->fields as $field) {

                $field_id = $field->field_id;

                if ($attrColumnAccessor = $this->getAttributeColumnAccessor($field_id)) {

                    $columnValue = $record->$attrColumnAccessor;

                    $columns[] = $this->getStringValueFromValue($columnValue);

                    continue;
                }

                $value = $record->$fieldValueRelationshipIdentifier->firstWhere($fieldValueFieldIdentifier, $field_id);


                if (!$value) {
                    $columns[] = '';

                    continue;
                }

                // FileType Form Field Values don't have a field_type property, so we will add one here
                if (!$value->field_type) {

                    $value->field_type = $field->field->field_type;
                }

                $columns[] = $this->getOutputValueFromValue($value);
            }

            yield($columns);
        }

    }


    private function getStringValueFromValue($columnValue)
    {
        if (is_string($columnValue)) {

            return $columnValue;
        }

        if ($columnValue instanceof \DateTime) {

            return \App\format_date_in_user_timezone($columnValue);
        }

        if (is_object($columnValue)) {

            return $columnValue->name;
        }

        if (is_array($columnValue)) {

            return implode("\n", $columnValue);
        }

        return $columnValue;
    }

    private function getOutputValueFromValue($value)
    {
        $columnValue = $this->dataMapper->getFieldValue($value);

        if ($value->field_type === 'money') {

            return \App\format_money($columnValue);
        }

        return $this->getStringValueFromValue($columnValue);
    }


    private function getAttributeValueColumn($filter)
    {
        $map = [
            'created_date' => 'created_at',
            'created_by' => 'created_by',
            'creator_id' => 'creator_id',
            'date' => 'date',
        ];

        return $map[$filter->field_id] ?? null;
    }

    private function getAttributeColumnAccessor($fieldId)
    {
        $map = [
            'created_date' => 'created_at',
            'created_by' => 'createdBy',
            'creator_id' => 'creator',
            'date' => 'date',
        ];

        return $map[$fieldId] ?? null;
    }



    private function queryOperator($filter)
    {
        $operator = '';
        switch ($filter->operator):

            case Filter::FILTER_OPERATOR_HAS_VALUE:
                $operator = '!=';
                break;

            case Filter::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE:
                $operator = '=';
                break;

            case Filter::FILTER_OPERATOR_CHECKED:
                $operator = '=';
                break;

            case Filter::FILTER_OPERATOR_NOT_CHECKED:
                $operator = '!=';
                break;

            case Filter::FILTER_OPERATOR_EQUALS:
                $operator = '=';
                break;

            case Filter::FILTER_OPERATOR_NOT_EQUALS:
                $operator = '!=';
                break;

            case Filter::FILTER_OPERATOR_GREATER_THAN:
                $operator = '>';
                break;

            case Filter::FILTER_OPERATOR_GREATER_THAN_EQUALS:
                $operator = '>=';
                break;

            case Filter::FILTER_OPERATOR_LESS_THAN:
                $operator = '<';
                break;

            case Filter::FILTER_OPERATOR_LESS_THAN_EQUALS:
                $operator = '<=';
                break;

            // This case should be handled in the calling method to change the query builder function to whereBetween
            case Filter::FILTER_OPERATOR_BETWEEN:
                $operator = '';
                break;

        endswitch;

        return $operator;
    }



    private function queryValue($filter)
    {
        $value = '';

        // User options
        if ($filter->value_1 === Filter::FILTER_VALUE_USER_GENERATING_REPORT) {

            return $this->userGeneratingReport->id;
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_USER_REPORT_FILTERED_USER) {

            return $this->userId;
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_USER_SPECIFIC_USER) {

            return $filter->value_2;
        }

        // Date options

        // Special rules because created_at is unix time, and we need to convert it to user's timezone
        if (in_array($filter->field_id, ['created_date'])) {

            $userTimezone = $this->userGeneratingReport->timezone;

            if ($filter->value_1 === Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {
                $dateFrom = new Carbon($filter->value_2, $userTimezone);
                $dateTo   = new Carbon($filter->value_2, $userTimezone);
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {
                $dateFrom = new Carbon($this->date_from, $userTimezone);
                $dateTo = new Carbon($this->date_to, $userTimezone);
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {
                $dateFrom = new Carbon($this->date, $userTimezone);
                $dateTo = new Carbon($this->date, $userTimezone);
            }

            $dateFrom->setTime(0, 0, 0)->setTimezone(config('app.timezone'));
            $dateTo->setTime(23, 59, 59)->setTimezone(config('app.timezone'));

            return [$dateFrom, $dateTo];
        }

        if (in_array($filter->field_id, ['date'])) {
            if ($filter->value_1 === Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {
                $dateFrom = $filter->value_2;
                $dateTo   = $filter->value_2;
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {
                $dateFrom = $this->date_from;
                $dateTo   = $this->date_to;
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {
                $dateFrom = $this->date;
                $dateTo   = $this->date;
            }

            return [
                date('Y-m-d', strtotime($dateFrom)),
                date('Y-m-d', strtotime($dateTo)),
            ];
        }


        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {

            if ($filter->operator === Filter::FILTER_OPERATOR_BETWEEN) {

                return [
                    date('Y-m-d', strtotime($filter->value_2)),
                    date('Y-m-d', strtotime($filter->value_3)),
                ];
            }

            return date('Y-m-d', strtotime($filter->value_2));
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {

            return  [
                date('Y-m-d', strtotime($this->date_from)),
                date('Y-m-d', strtotime($this->date_to)),
            ];
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {

            return date('Y-m-d', strtotime($this->date));
        }




        switch ($filter->operator):

            case Filter::FILTER_OPERATOR_HAS_VALUE:
            case Filter::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE:
                $value = null;
                break;

            case Filter::FILTER_OPERATOR_CHECKED:
            case Filter::FILTER_OPERATOR_NOT_CHECKED:
                $value = 1;
                break;

            case Filter::FILTER_OPERATOR_EQUALS:
            case Filter::FILTER_OPERATOR_NOT_EQUALS:
            case Filter::FILTER_OPERATOR_GREATER_THAN:
            case Filter::FILTER_OPERATOR_GREATER_THAN_EQUALS:
            case Filter::FILTER_OPERATOR_LESS_THAN:
            case Filter::FILTER_OPERATOR_LESS_THAN_EQUALS:

                $value = $filter->value_1;
                break;

            case Filter::FILTER_OPERATOR_BETWEEN:
                $value = [$filter->value_1, $filter->value_2];
                break;

        endswitch;

        return $value;
    }
}
