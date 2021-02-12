<?php


namespace App\Navigation\LocationBar\Admin\Reports\Datasets;


use App\Navigation\LocationBar;
use App\Report;
use App\Report\Dataset;

class Show extends LocationBar
{
    public function __construct(Report $report, Dataset $dataset)
    {
        parent::__construct($dataset->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets($report));

    }
}
