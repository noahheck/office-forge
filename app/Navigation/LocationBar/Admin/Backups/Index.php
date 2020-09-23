<?php


namespace App\Navigation\LocationBar\Admin\Backups;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.backups'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
