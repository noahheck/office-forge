<?php


namespace App\Report\ResultSet\Compiler;


use App\File\FormField\Value as FormFieldValue;
use App\FormDoc\Field as FormDocField;
use App\FileType\Form\Field as FileTypeFormFieldModel;
use App\Form\DataMapper;
use App\FormDoc\Template\Field as FormDocTemplateFieldModel;
use App\Report\Dataset\Filter;

class FormFilteredInstanceProvider
{
    /**
     * @var FormFieldValue
     */
    private $valueModel;

    /**
     * @var FormDocField
     */
    private $formDocFieldModel;

    /**
     * @var FileTypeFormFieldModel
     */
    private $fileTypeFormFieldModel;

    /**
     * @var FormDocTemplateFieldModel
     */
    private $formDocTemplateFieldModel;

    /**
     * @var DataMapper
     */
    private $dataMapper;

    /**
     * @var Operator
     */
    private $operator;

    /**
     * @var QueryValue
     */
    private $queryValue;

    public function __construct(
        FormFieldValue $valueModel,
        FormDocField $formDocFieldModel,
        FileTypeFormFieldModel $fileTypeFormFieldModel,
        FormDocTemplateFieldModel $formDocTemplateFieldModel,
        DataMapper $dataMapper,
        Operator $operator,
        QueryValue $queryValue
    ) {
        $this->valueModel = $valueModel;
        $this->formDocFieldModel = $formDocFieldModel;
        $this->fileTypeFormFieldModel = $fileTypeFormFieldModel;
        $this->formDocTemplateFieldModel = $formDocTemplateFieldModel;
        $this->dataMapper = $dataMapper;
        $this->operator = $operator;
        $this->queryValue = $queryValue;
    }

    public function getFormFilteredInstanceIdsForDataset($dataset, $runtimeValues, $instanceIds)
    {
        $datasetable = $dataset->datasetable;

        $fieldRecordIdentifier = $datasetable->instanceFieldRecordIdentifier();


        foreach ($dataset->instanceFormFilters() as $filter) {


            if ($dataset->isFileType()) {

                $formField = $this->fileTypeFormFieldModel->find($filter->field_id);

                $valueColumn = $this->dataMapper->getFieldValueColumn($formField);

                $queryBuilder = $this->valueModel
                    ->where('file_type_form_field_id', $filter->field_id);

            } elseif ($dataset->isFormDocTemplate()) {

                $formField = $this->formDocTemplateFieldModel->find($filter->field_id);

                $valueColumn = $this->dataMapper->getFieldValueColumn($formField);

                $queryBuilder = $this->formDocFieldModel
                    ->where('form_doc_template_field_id', $filter->field_id);

            }


            if ($filter->operator === Filter::FILTER_OPERATOR_BETWEEN) {

                $queryBuilder->whereBetween($valueColumn, $this->queryValue->queryValueForFilter($filter, $runtimeValues));

            } elseif ($filter->operator === Filter::FILTER_OPERATOR_NOT_CHECKED) {

                    // The not-checked filter needs to include a check for NULL column value because of, well, reasons
                    // In mysql, NULL doesn't != 1, so we get false negatives (it also doesn't != 0, so, there's that)
                    $queryBuilder->where(function($query) use ($valueColumn, $filter, $runtimeValues) {
                        $query->where(
                            $valueColumn,
                            $this->operator->queryOperatorForFilter($filter),
                            $this->queryValue->queryValueForFilter($filter, $runtimeValues)
                        )->orWhereNull($valueColumn);
                    });

            } else {

                $queryBuilder->where(
                    $valueColumn,
                    $this->operator->queryOperatorForFilter($filter),
                    $this->queryValue->queryValueForFilter($filter, $runtimeValues)
                );
            }

            $queryBuilder->whereIn($fieldRecordIdentifier, $instanceIds);

            $results = $queryBuilder->get();

            $instanceIds = $results->pluck($fieldRecordIdentifier);
        }


        return $instanceIds;
    }
}
