<?php


namespace App\Navigation\Link\Admin\Reports\Datasets;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;

class Fields extends Link
{
    public function __construct(Report $report, Dataset $dataset)
    {
        parent::__construct(route('admin.reports.datasets.fields.index', [$report, $dataset]), __('report.fields'));
    }
}
