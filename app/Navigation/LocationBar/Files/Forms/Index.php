<?php


namespace App\Navigation\LocationBar\Files\Forms;


use App\File;
use App\FileType;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(FileType $fileType, File $file)
    {
        parent::__construct(__('file.forms'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
    }
}
