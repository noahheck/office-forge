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
            Visualization::VISUALIZATION_TYPE_SINGLE_FIELD_AGGREGATE => 'SingleFieldAggregate',
            Visualization::VISUALIZATION_TYPE_RANGE_FIELD_AVERAGE => 'RangeFieldAverage',
            Visualization::VISUALIZATION_TYPE_MULTI_RANGE_FIELD_AVERAGE => 'MultiRangeFieldAverage',
            Visualization::VISUALIZATION_TYPE_MULTI_FIELD_TREND_WITH_AVERAGE => 'MultiFieldTrendWithAverage',
        ];
    }

    public function forVisualization(Visualization $visualization)
    {
        $classname = 'App\Report\ResultSet\Visualization\Resolver\\';

        $classname .= self::visualizationResolvers()[$visualization->type] ?? 'NullResolver';

        return $classname;
    }
}
