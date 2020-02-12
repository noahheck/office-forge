<?php


namespace App\Navigation\LocationBar\Admin\Processes;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.processes'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
