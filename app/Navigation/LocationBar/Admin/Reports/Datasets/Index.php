<?php


namespace App\Navigation\LocationBar\Admin\Reports\Datasets;


use App\Navigation\LocationBar;
use App\Report;

class Index extends LocationBar
{
    public function __construct(Report $report)
    {
        parent::__construct(__('report.datasets'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
    }
}
