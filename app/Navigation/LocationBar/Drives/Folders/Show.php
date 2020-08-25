<?php


namespace App\Navigation\LocationBar\Drives\Folders;


use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(Drive $drive, Folder $folder)
    {
        parent::__construct($folder->name);

        $this->addLink(new \App\Navigation\Link\FileStore);
        $this->addLink(new \App\Navigation\Link\Drives\Show($drive));
        $this->addLink(new \App\Navigation\Link\Drives\Folders($drive));
    }
}
