<?php


namespace App\Navigation\LocationBar\Projects;


use App\Navigation\LocationBar;
use App\Project;

class Show extends LocationBar
{
    public function __construct(Project $project)
    {
        parent::__construct($project->name);

        $this->addLink(new \App\Navigation\Link\Projects);
    }
}
