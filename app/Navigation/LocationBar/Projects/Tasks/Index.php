<?php


namespace App\Navigation\LocationBar\Projects\Tasks;


use App\Navigation\LocationBar;
use App\Project;

class Index extends LocationBar
{
    public function __construct(Project $project)
    {
        parent::__construct(__('project.tasks'));

        $this->addLink(new \App\Navigation\Link\Projects);
        $this->addLink(new \App\Navigation\Link\Projects\Show($project));
    }
}
