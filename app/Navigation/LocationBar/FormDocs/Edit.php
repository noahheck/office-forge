<?php


namespace App\Navigation\LocationBar\FormDocs;


use App\Activity;
use App\FormDoc;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(FormDoc $formDoc)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\FormDocs);
        $this->addLink(new \App\Navigation\Link\FormDocs\Show($formDoc));
    }
}
