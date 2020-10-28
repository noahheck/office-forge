<?php


namespace App\Navigation\LocationBar\Files\Drives;


use App\File;
use App\FileType;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(FileType $fileType, File $file)
    {
        parent::__construct(__('fileStore.drives'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
    }
}
