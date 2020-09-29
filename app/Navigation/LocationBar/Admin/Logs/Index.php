<?php


namespace App\Navigation\LocationBar\Admin\Logs;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.logs'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
