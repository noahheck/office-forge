<?php


namespace App\Navigation\LocationBar\Admin\Server;


use App\Navigation\LocationBar;

class UpdateSettings extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.server_updateSettings'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Server);
    }
}
