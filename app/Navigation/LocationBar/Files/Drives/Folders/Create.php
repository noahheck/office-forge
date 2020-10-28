<?php


namespace App\Navigation\LocationBar\Files\Drives\Folders;


use App\File;
use App\FileStore\Drive;
use App\FileType;
use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct(FileType $fileType, File $file, Drive $drive)
    {
        parent::__construct(__('fileStore.newFolder'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives\Show($file, $drive));
    }
}
