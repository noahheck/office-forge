<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Chart\GaugeChart;
use App\Chart\RadarChart;
use App\Chart\Table;
use App\Report\Dataset\Visualization;
use App\Report\ResultSet;
use function App\format_float;

class MultiRangeFieldAverage
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
        $table = new Table($visualization->label);
        $table->setHeaders([
            $visualization->label,
            ''
        ]);

        $chart = new RadarChart($visualization->label);

        $max = 0;

        $fieldIds = $visualization->options->multiple_field_ids;

        foreach ($fieldIds as $fieldId) {

            $fieldDetails = $resultSet->fieldDetails($fieldId);

            $label = $fieldDetails->label;

            $average = $resultSet->records()->avg(function($record) use ($fieldId, &$max) {

                $field = $record->fields()->firstWhere('datasetFieldId', $fieldId);

                $fieldMax = optional($field->value->options)->range_max;

                if ($fieldMax > $max) {
                    $max = $fieldMax;
                }

                return format_float($field->label);
            });

            $table->addRecord([$label, $average]);
            $chart->addDataToDataset($label, $average);
        }

        $chart->setMax($max);

        return [
            'chart' => $chart,
            'table' => $table,
        ];
    }
}
