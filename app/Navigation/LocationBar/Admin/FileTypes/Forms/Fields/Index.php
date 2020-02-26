<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields;


use App\FileType;
use App\FileType\Form;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(FileType $fileType, Form $form)
    {
        parent::__construct(__('file.fields'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Show($fileType, $form));
    }
}
