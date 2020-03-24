<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Panels;


use App\FileType;
use App\FileType\Form;
use App\FileType\Panel;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(FileType $fileType, Panel $panel)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Panels($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Panels\Show($fileType, $panel));
    }
}
