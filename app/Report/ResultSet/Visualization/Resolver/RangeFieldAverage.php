<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Chart\GaugeChart;
use App\Chart\Table;
use App\Report\Dataset\Visualization;
use App\Report\ResultSet;
use function App\format_float;

class RangeFieldAverage
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
        $table = new Table($visualization->label);
        $table->setHeaders([
            $visualization->field->label,
            ''
        ]);

        $max = $visualization->field->templateField->options->range_max;

        $average = $resultSet->records()->avg(function($record) use ($visualization, $table) {

            $field = $record->fields()->firstWhere('datasetFieldId', $visualization->field_id);

            $table->addRecord([$record->resourceTitle(), $field->label]);

            return format_float($field->label);
        });

        $chart = new GaugeChart($average, '', null, null, $average, $max);

        return [
            'chart' => $chart,
            'table' => $table,
        ];
    }
}
