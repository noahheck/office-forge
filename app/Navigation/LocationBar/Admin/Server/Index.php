<?php


namespace App\Navigation\LocationBar\Admin\Server;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.server'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
