<?php


namespace App\Navigation\LocationBar\Admin\Server\Update;


use App\Navigation\LocationBar;

class Update extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.server_update'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Server);
        $this->addLink(new \App\Navigation\Link\Admin\Server\UpdateHistory);

    }
}
