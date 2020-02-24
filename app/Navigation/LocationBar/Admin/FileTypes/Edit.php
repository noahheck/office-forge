<?php


namespace App\Navigation\LocationBar\Admin\FileTypes;


use App\FileType;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(FileType $file)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($file));
    }
}
