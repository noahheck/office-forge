<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Visualization extends Model
{
    const VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT = 'total_records_count';

    protected $table = 'report_dataset_visualizations';

    public static function visualizationTypeOptions()
    {
        return collect([
            self::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT => __('report.visualizationType_total_records_count'),
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
}
