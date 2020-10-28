<?php


namespace App\Navigation\LocationBar\Admin\Drives;


use App\Authorization\Administrator;
use App\FileStore\Drive;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(Drive $drive)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Drives);
        $this->addLink(new \App\Navigation\Link\Admin\Drives\Show($drive));
    }
}
