<?php


namespace App\Report\ResultSet\Record;


use App\Form\DataMapper;
use App\Report\ResultSet\Record;

class Compiler
{
    /**
     * @var DataMapper
     */
    private $dataMapper;

    public function __construct(DataMapper $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    public function compileRecord($instance, $dataset)
    {
        $record = new Record($instance);

        $datasetable = $dataset->datasetable;

        $fieldValueRelationshipIdentifier = $datasetable->instanceFieldValueRelationshipIdentifier();
        $fieldValueFieldIdentifier = $datasetable->instanceFieldValueFieldIdentifier();

        foreach ($dataset->fields as $field) {

            $field_id = $field->field_id;

            if ($attrColumnAccessor = $this->getAttributeColumnAccessor($field_id)) {

                $columnValue = $instance->$attrColumnAccessor;

                $record->addField(new Field(
                    $field_id, $columnValue, $this->getStringValueFromValue($columnValue)
                ));

                continue;
            }

            $value = $instance->$fieldValueRelationshipIdentifier->firstWhere($fieldValueFieldIdentifier, $field_id);


            if (!$value) {
                $record->addField(new Field($field_id, '', ''));

                continue;
            }

            // FileType Form Field Values don't have a field_type property, so we will add one here
            if (!$value->field_type) {

                $value->field_type = $field->field->field_type;
            }

            $record->addField(new Field($field_id, $value, $this->getOutputValueFromValue($value)));

        }

        return $record;
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
}
