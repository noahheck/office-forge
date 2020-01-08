<?php


namespace App\Navigation\LocationBar\Link\Projects;


use App\Navigation\LocationBar\Link;
use App\Project;

class Tasks extends Link
{
    public function __construct(Project $project)
    {
        parent::__construct(route('projects.tasks.index', [$project]), __('project.tasks'));
    }
}
