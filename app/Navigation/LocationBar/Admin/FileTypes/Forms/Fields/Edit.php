<?php


namespace App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields;


use App\FileType;
use App\FileType\Form;
use App\FileType\Form\Field;
use App\Navigation\LocationBar;
use App\Process;
use App\Process\Task;
use App\Process\Task\Action;

class Edit extends LocationBar
{
    public function __construct(FileType $fileType, Form $form, Field $field)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes);
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Show($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms($fileType));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Show($fileType, $form));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Fields($fileType, $form));
        $this->addLink(new \App\Navigation\Link\Admin\FileTypes\Forms\Fields\Show($fileType, $form, $field));
    }
}
