<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Forms;


use App\FileType;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(FileType $fileType, FileType\Form $form)
    {
        parent::__construct($form->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms($fileType));
    }
}
