<?php


namespace App\Navigation\Link\Admin\Reports\Datasets;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;

class Visualizations extends Link
{
    public function __construct(Report $report, Dataset $dataset)
    {
        parent::__construct(route('admin.reports.datasets.visualizations.index', [$report, $dataset]), __('report.visualizations'));
    }
}
