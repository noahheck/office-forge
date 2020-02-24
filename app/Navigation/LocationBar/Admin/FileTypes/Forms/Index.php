<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Forms;


use App\FileType;
use App\Navigation\LocationBar;
use App\Process;

class Index extends LocationBar
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(__('file.forms'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
    }
}
