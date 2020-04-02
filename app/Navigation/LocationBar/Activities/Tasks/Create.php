<?php


namespace App\Navigation\LocationBar\Activities\Tasks;


use App\Navigation\LocationBar;
use App\Project;

class Create extends LocationBar
{
    public function __construct(Project $project)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($project));
        $this->addLink(new \App\Navigation\Link\Activities\Tasks($project));
    }
}
