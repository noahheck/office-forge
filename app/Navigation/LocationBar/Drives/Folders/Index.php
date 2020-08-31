<?php


namespace App\Navigation\LocationBar\Drives\Folders;


use App\FileStore\Drive;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(Drive $drive)
    {
        parent::__construct(__('fileStore.folders'));

        $this->addLink(new \App\Navigation\Link\FileStore);
        $this->addLink(new \App\Navigation\Link\Drives\Show($drive));
    }
}
