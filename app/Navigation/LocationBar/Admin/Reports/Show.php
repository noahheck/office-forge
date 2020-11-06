<?php


namespace App\Navigation\LocationBar\Admin\Reports;


use App\Navigation\LocationBar;
use App\Report;

class Show extends LocationBar
{
    public function __construct(Report $report)
    {
        parent::__construct($report->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
    }
}
