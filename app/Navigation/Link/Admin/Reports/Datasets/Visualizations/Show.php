<?php


namespace App\Navigation\Link\Admin\Reports\Datasets\Visualizations;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Visualization;

class Show extends Link
{
    public function __construct(Report $report, Dataset $dataset, Visualization $visualization)
    {
        parent::__construct(route('admin.reports.datasets.visualizations.show', [$report, $dataset, $visualization]), $visualization->label);
    }
}
