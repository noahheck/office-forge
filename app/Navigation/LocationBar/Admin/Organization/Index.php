<?php


namespace App\Navigation\LocationBar\Admin\Organization;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.organizationDetails'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
