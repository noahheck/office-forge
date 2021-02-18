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

    protected $table = 'report_dataset_visualizations';

    public static function visualizationTypeOptions()
    {
        return collect([
            self::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT => __('report.visualizationType_total_records_count'),
            self::VISUALIZATION_TYPE_FIELD_VALUE_SUM => __('report.visualizationType_field_value_sum'),
            self::VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE => __('report.visualizationType_field_value_average'),
            self::VISUALIZATION_TYPE_SINGLE_FIELD_AGGREGATE => __('report.visualizationType_single_field_aggregate'),
            self::VISUALIZATION_TYPE_RANGE_FIELD_AVERAGE => __('report.visualizationType_range_field_average'),
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
