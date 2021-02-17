<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Chart\PieChart;
use App\Chart\Table;
use App\Report\Dataset\Visualization;
use App\Report\ResultSet;

class SingleFieldAggregate
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
//        $chart = new PieChart($visualization->label);
        $chart = new PieChart();

        $table = new Table($visualization->label);
        $table->setHeaders([
            $visualization->field->label,
            ''
        ]);

        $fields = $resultSet->records()->map(function($record) use ($visualization) {

            return $record->fields()->firstWhere('datasetFieldId', $visualization->field_id);
        });

        $fieldValues = $fields->pluck('label')->countBy()->sortKeys();

        $fieldValues->each(function($item, $key) use ($chart, $table) {
            $chart->addDataToDataset($key, $item);
            $table->addRecord([$key, $item]);
        });


        return [
            'chart' => $chart,
            'table' => $table,
        ];
    }
}
