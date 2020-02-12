<?php


namespace App\Navigation\Link\Projects;


use App\Navigation\Link;
use App\Project;

class Show extends Link
{
    public function __construct(Project $project)
    {
        parent::__construct(route('projects.show', [$project]), $project->name);
    }
}
