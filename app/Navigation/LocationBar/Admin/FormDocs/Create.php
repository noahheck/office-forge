<?php


namespace App\Navigation\LocationBar\Admin\FormDocs;


use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\FormDocs);
    }
}
