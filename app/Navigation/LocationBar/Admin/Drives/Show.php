<?php


namespace App\Navigation\LocationBar\Admin\Drives;


use App\FileStore\Drive;
use App\Navigation\LocationBar;
use App\Team;

class Show extends LocationBar
{
    public function __construct(Drive $drive)
    {
        parent::__construct($drive->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Drives);
    }
}
