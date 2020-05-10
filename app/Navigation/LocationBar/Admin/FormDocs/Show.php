<?php


namespace App\Navigation\LocationBar\Admin\FormDocs;


use App\FormDoc\Template;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(Template $formDoc)
    {
        parent::__construct($formDoc->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
    }
}
