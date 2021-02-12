<?php


namespace App\Report\ResultSet\Visualization;


use App\Report\Dataset\Visualization;

class ResolverMapper
{
    public function __construct()
    {

    }

    public static function visualizationResolvers()
    {
        return [
            Visualization::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT => 'TotalRecordsCount',
            Visualization::VISUALIZATION_TYPE_FIELD_VALUE_SUM     => 'FieldValueSum',
            Visualization::VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE => 'FieldValueAverage',
        ];
    }

    public function forVisualization(Visualization $visualization)
    {
        $classname = 'App\Report\ResultSet\Visualization\Resolver\\';

        $classname .= self::visualizationResolvers()[$visualization->type] ?? 'NullResolver';

        return $classname;
    }
}
