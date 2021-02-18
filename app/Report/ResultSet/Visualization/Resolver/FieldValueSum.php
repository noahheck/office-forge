<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Report\Dataset\Visualization;
use App\Report\ResultSet;
use function App\format_float;

class FieldValueSum
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
        return $resultSet->records()->sum(function($record) use ($visualization) {

            $field = $record->fields()->firstWhere('datasetFieldId', $visualization->field_id);

            return format_float($field->label);
        });
    }
}
