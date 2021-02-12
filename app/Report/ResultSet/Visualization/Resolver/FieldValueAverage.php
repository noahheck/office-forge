<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Report\Dataset\Visualization;
use App\Report\ResultSet;

class FieldValueAverage
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
        $average = $resultSet->records()->avg(function($record) use ($visualization) {

            $field = $record->fields()->firstWhere('datasetFieldId', $visualization->field_id);

            return $field->label;
        });

        return \App\format_decimal($average);
    }
}
