<?php

namespace App;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    const REPORT_FILTER_DATE_NONE = 0;
    const REPORT_FILTER_DATE_DATE = 1;
    const REPORT_FILTER_DATE_RANGE = 2;

    use SoftDeletes;

    public static function dateFilterOptions()
    {
        return [
            self::REPORT_FILTER_DATE_NONE => [
                'label' => __('report.report_filter_date_none'),
                'description' => __('report.report_filter_date_noneDescription'),
            ],
            self::REPORT_FILTER_DATE_DATE => [
                'label' => __('report.report_filter_date_date'),
                'description' => __('report.report_filter_date_dateDescription'),
            ],
            self::REPORT_FILTER_DATE_RANGE => [
                'label' => __('report.report_filter_date_date_range'),
                'description' => __('report.report_filter_date_date_rangeDescription'),
            ],
        ];
    }

    protected $casts = [
        'active' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'reports_teams', 'report_id', 'team_id')->withTimestamps();
    }

    public function datasets()
    {
        return $this->hasMany(Dataset::class, 'report_id')->orderBy('order', 'ASC');
    }
}
