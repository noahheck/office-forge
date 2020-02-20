<?php


namespace App\Navigation\LocationBar\Files;


use App\FileType;
use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(__('app.new') . ' ' . $fileType->name);

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
    }
}
