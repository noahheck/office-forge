<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Chart\GaugeChart;
use App\Chart\LineChart;
use App\Chart\RadarChart;
use App\Chart\Table;
use App\Report\Dataset\Visualization;
use App\Report\ResultSet;
use function App\format_decimal;
use function App\format_float;

class MultiFieldTrendWithAverage
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
        $table = new Table($visualization->label);
        $table->setHeaders([
            $visualization->label,
            __('app.average'),
        ]);

        $chart = new LineChart($visualization->label);

        $labels = $resultSet->records()->map(function($record) {
            return $record->resource->date;
        });

        $chart->setLabels($labels);

        $fieldIds = $visualization->options->multiple_field_ids;

        foreach ($fieldIds as $fieldId) {

            $label = '';
            $values = [];

            $average = $resultSet->records()->avg(function($record) use ($fieldId, &$label, &$values) {

                $field = $record->fields()->firstWhere('datasetFieldId', $fieldId);

                if (!$label) {
                    $label = $field->value->label;
                }

                $values[] = $field->label;

                return format_float($field->label);
            });

            $table->addRecord([$label, format_decimal($average)]);
            $chart->addDataset($label, $values);
        }

        return [
            'chart' => $chart,
            'table' => $table,
        ];
    }
}
