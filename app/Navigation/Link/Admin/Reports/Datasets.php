<?php


namespace App\Navigation\Link\Admin\Reports;


use App\Navigation\Link;
use App\Report;

class Datasets extends Link
{
    public function __construct(Report $report)
    {
        parent::__construct(route('admin.reports.datasets.index', [$report]), __('report.datasets'));
    }
}
