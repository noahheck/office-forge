<?php


namespace App\Navigation\LocationBar\Admin\FormDocs\Fields;


use App\FileType;
use App\FormDoc;
use App\Navigation\LocationBar;
use App\Process;

class Index extends LocationBar
{
    public function __construct(FormDoc $formDoc)
    {
        parent::__construct(__('file.forms'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs\Show($formDoc));
    }
}
