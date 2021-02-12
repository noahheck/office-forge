<?php


namespace App\Navigation\LocationBar\Admin\Reports;


use App\FileType;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.reports'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
