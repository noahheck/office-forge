<?php


namespace App\Navigation\Link\Admin\Reports\Datasets\Filters;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Filter;
use App\Report\Dataset\Filter\Descriptor;

class Show extends Link
{
    public function __construct(Report $report, Dataset $dataset, Filter $filter)
    {
        $filterDescriptor = app()->make(Descriptor::class);

        parent::__construct(route('admin.reports.datasets.filters.show', [$report, $dataset, $filter]), $filterDescriptor->descriptorForFilter($filter));
    }
}
