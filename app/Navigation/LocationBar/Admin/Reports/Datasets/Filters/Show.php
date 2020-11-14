<?php


namespace App\Navigation\LocationBar\Admin\Reports\Datasets\Filters;


use App\Navigation\LocationBar;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Filter;

class Show extends LocationBar
{
    public function __construct(Report $report, Dataset $dataset, Filter $filter)
    {
        parent::__construct($filter->descriptor());

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Show($report, $dataset));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Filters($report, $dataset));

    }
}
