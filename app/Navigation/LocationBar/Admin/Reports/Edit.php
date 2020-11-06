<?php


namespace App\Navigation\LocationBar\Admin\Reports;


use App\Navigation\LocationBar;
use App\Report;

class Edit extends LocationBar
{
    public function __construct(Report $report)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
    }
}
