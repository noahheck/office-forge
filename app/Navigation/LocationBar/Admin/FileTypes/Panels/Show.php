<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Panels;


use App\FileType;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(FileType $fileType, FileType\Panel $panel)
    {
        parent::__construct($panel->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Panels($fileType));
    }
}
