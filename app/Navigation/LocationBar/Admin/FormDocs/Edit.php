<?php


namespace App\Navigation\LocationBar\Admin\FormDocs;


use App\FormDoc\Template;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(Template $formDoc)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Show($formDoc));
    }
}
