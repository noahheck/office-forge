<?php


namespace App\Navigation\LocationBar\Admin\FileTypes;


use App\FileType;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(FileType $file)
    {
        parent::__construct($file->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
    }
}
