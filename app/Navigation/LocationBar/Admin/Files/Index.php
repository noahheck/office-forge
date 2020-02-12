<?php


namespace App\Navigation\LocationBar\Admin\Files;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.files'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
