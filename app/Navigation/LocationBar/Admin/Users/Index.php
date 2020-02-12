<?php


namespace App\Navigation\LocationBar\Admin\Users;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.users'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
