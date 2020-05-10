<?php


namespace App\Navigation\LocationBar\Admin\FormDocs\Fields;


use App\FormDoc\Template;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(Template $formDoc)
    {
        parent::__construct(__('formDoc.fields'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Show($formDoc));
    }
}
