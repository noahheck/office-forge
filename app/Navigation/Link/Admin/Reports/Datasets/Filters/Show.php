<?php


namespace App\Navigation\Link\Admin\Reports\Datasets\Filters;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Filter;

class Show extends Link
{
    public function __construct(Report $report, Dataset $dataset, Filter $filter)
    {
        parent::__construct(route('admin.reports.datasets.filters.show', [$report, $dataset, $filter]), $filter->descriptor());
    }
}
