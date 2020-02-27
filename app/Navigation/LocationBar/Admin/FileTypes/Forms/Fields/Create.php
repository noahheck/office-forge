<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields;


use App\FileType;
use App\FileType\Form;
use App\Navigation\LocationBar;
use App\Process;
use App\Process\Task;

class Create extends LocationBar
{
    public function __construct(FileType $fileType, Form $form)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Show($fileType, $form));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Fields($fileType, $form));
    }
}
