<?php


namespace App\Navigation\LocationBar\Files\Drives\Folders;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileType;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(File $file, FileType $fileType, Drive $drive)
    {
        parent::__construct(__('fileStore.folders'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives\Show($file, $drive));
    }
}
