<?php


namespace App\Navigation\Link\Admin\Reports;


use App\Navigation\Link;
use App\Report;

class Show extends Link
{
    public function __construct(Report $report)
    {
        parent::__construct(route('admin.reports.show', [$report]), $report->name);
    }
}
