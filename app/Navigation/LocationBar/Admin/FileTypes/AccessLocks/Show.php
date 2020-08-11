<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\AccessLocks;


use App\FileType;
use App\FileType\AccessLock;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(FileType $fileType, AccessLock $accessLock)
    {
        parent::__construct($accessLock->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\AccessLocks($fileType));
    }
}
