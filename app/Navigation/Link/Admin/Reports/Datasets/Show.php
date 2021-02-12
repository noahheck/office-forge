<?php


namespace App\Navigation\Link\Admin\Reports\Datasets;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;

class Show extends Link
{
    public function __construct(Report $report, Dataset $dataset)
    {
        parent::__construct(route('admin.reports.datasets.show', [$report, $dataset]), $dataset->name);
    }
}
