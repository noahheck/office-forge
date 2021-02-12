<?php


namespace App\Report\ResultSet\Visualization;


use App\Report\Dataset\Visualization;

class TemplateMapper
{
    public function __construct()
    {

    }

    public static function visualizationTemplates()
    {
        return [
            Visualization::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT => 'single_value',
            Visualization::VISUALIZATION_TYPE_FIELD_VALUE_SUM     => 'single_value',
            Visualization::VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE => 'single_value',
        ];
    }

    public function forVisualization(Visualization $visualization)
    {
        return self::visualizationTemplates()[$visualization->type] ?? 'error';
    }
}
