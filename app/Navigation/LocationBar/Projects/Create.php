<?php


namespace App\Navigation\LocationBar\Projects;


use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Projects);
    }
}
