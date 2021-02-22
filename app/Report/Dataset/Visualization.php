<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Visualization extends Model
{
    const VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT = 'total_records_count';
    const VISUALIZATION_TYPE_FIELD_VALUE_SUM = 'field_value_sum';
    const VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE = 'field_value_average';

    const VISUALIZATION_TYPE_SINGLE_FIELD_AGGREGATE = 'single_field_aggregate';

    const VISUALIZATION_TYPE_RANGE_FIELD_AVERAGE = 'range_field_average';
    const VISUALIZATION_TYPE_MULTI_RANGE_FIELD_AVERAGE = 'multi_range_field_average';

    const VISUALIZATION_TYPE_MULTI_FIELD_TREND_WITH_AVERAGE = 'multi_field_trend_with_average';

    protected $table = 'report_dataset_visualizations';

    protected $casts = [
        'options' => 'object',
    ];

    public static function visualizationTypeOptions()
    {
        return collect([
            self::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT => __('report.visualizationType_total_records_count'),
            self::VISUALIZATION_TYPE_FIELD_VALUE_SUM => __('report.visualizationType_field_value_sum'),
            self::VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE => __('report.visualizationType_field_value_average'),
            self::VISUALIZATION_TYPE_SINGLE_FIELD_AGGREGATE => __('report.visualizationType_single_field_aggregate'),
            self::VISUALIZATION_TYPE_RANGE_FIELD_AVERAGE => __('report.visualizationType_range_field_average'),
            self::VISUALIZATION_TYPE_MULTI_RANGE_FIELD_AVERAGE => __('report.visualizationType_multi_range_field_average'),
            self::VISUALIZATION_TYPE_MULTI_FIELD_TREND_WITH_AVERAGE => __('report.visualizationType_multi_field_trend_with_average'),

        ]);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
}
