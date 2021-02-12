<?php


namespace App\Navigation\LocationBar\Admin\Reports\Datasets;


use App\Navigation\LocationBar;
use App\Report;

class Create extends LocationBar
{
    public function __construct(Report $report)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets($report));

    }
}
