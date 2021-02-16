<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Visualization extends Model
{
    const VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT = 'total_records_count';
    const VISUALIZATION_TYPE_FIELD_VALUE_SUM = 'field_value_sum';
    const VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE = 'field_value_average';

    const VISUALIZATION_TYPE_FIELD_AGGREGATE_ANALYSIS = 'field_value_aggregate_analysis';

    protected $table = 'report_dataset_visualizations';

    public static function visualizationTypeOptions()
    {
        return collect([
            self::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT => __('report.visualizationType_total_records_count'),
            self::VISUALIZATION_TYPE_FIELD_VALUE_SUM => __('report.visualizationType_field_value_sum'),
            self::VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE => __('report.visualizationType_field_value_average'),
            self::VISUALIZATION_TYPE_FIELD_AGGREGATE_ANALYSIS => __('report.visualizationType_field_value_aggregate_analysis'),
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
