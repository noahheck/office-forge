<?php


namespace App\Navigation\LocationBar\Link\Projects;


use App\Navigation\LocationBar\Link;
use App\Project;

class Show extends Link
{
    public function __construct(Project $project)
    {
        parent::__construct(route('projects.show', [$project]), e($project->name));
    }
}
