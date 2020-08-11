<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\AccessLocks;


use App\FileType;
use App\Navigation\LocationBar;
use App\Process;

class Create extends LocationBar
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\AccessLocks($fileType));
    }
}
