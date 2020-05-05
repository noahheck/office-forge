<?php


namespace App\Navigation\LocationBar\Admin\FormDocs;


use App\FileType;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('file.formDocs'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
    }
}
