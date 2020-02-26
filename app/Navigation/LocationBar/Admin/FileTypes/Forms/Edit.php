<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Forms;


use App\FileType;
use App\FileType\Form;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(FileType $fileType, Form $form)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Show($fileType, $form));
    }
}
