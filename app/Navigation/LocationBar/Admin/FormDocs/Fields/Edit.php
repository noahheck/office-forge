<?php


namespace App\Navigation\LocationBar\Admin\FormDocs\Fields;


use App\FormDoc\Template;
use App\FormDoc\Template\Field;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(Template $formDoc, Field $field)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Show($formDoc));
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Fields($formDoc));
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Fields\Show($formDoc, $field));
    }
}
