<?php


namespace App\Navigation\LocationBar\Drives\Folders;


use App\FileStore\Drive;
use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct(Drive $drive)
    {
        parent::__construct(__('fileStore.newFolder'));

        $this->addLink(new \App\Navigation\Link\FileStore);
        $this->addLink(new \App\Navigation\Link\Drives\Show($drive));
    }
}
