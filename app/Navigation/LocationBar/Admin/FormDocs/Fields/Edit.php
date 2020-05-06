<?php


namespace App\Navigation\LocationBar\Admin\FormDocs\Fields;


use App\FormDoc;
use App\FormDoc\Field;
use App\Navigation\LocationBar;
use App\Process;
use App\Process\Task;

class Edit extends LocationBar
{
    public function __construct(FormDoc $formDoc, Field $field)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Show($formDoc));
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Fields($formDoc));
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Fields\Show($formDoc, $field));
    }
}
