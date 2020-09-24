<?php


namespace App\Navigation\LocationBar\Admin\Backups;


use App\Navigation\LocationBar;

class Settings extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.settings'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Backups);
    }
}
