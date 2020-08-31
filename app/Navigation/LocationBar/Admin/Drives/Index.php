<?php


namespace App\Navigation\LocationBar\Admin\Drives;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('fileStore.drives'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
