<?php


namespace App\Navigation\LocationBar\Files;


use App\File;
use App\FileType;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(FileType $fileType, File $file)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
    }
}
