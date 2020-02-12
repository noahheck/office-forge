<?php


namespace App\Navigation\LocationBar\Projects\Tasks;


use App\Navigation\LocationBar;
use App\Project;

class Create extends LocationBar
{
    public function __construct(Project $project)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Projects);
        $this->addLink(new \App\Navigation\Link\Projects\Show($project));
        $this->addLink(new \App\Navigation\Link\Projects\Tasks($project));
    }
}
