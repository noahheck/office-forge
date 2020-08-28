<?php


namespace App\Navigation\LocationBar\Drives\MediaFiles;


use App\FileStore\Drive;
use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct(Drive $drive)
    {
        parent::__construct(__('fileStore.uploadFile'));

        $this->addLink(new \App\Navigation\Link\FileStore);
        $this->addLink(new \App\Navigation\Link\Drives\Show($drive));
    }
}
