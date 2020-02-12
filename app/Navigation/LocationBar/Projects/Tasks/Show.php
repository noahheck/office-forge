<?php


namespace App\Navigation\LocationBar\Projects\Tasks;


use App\Navigation\LocationBar;
use App\Project;
use App\Project\Task;

class Show extends LocationBar
{
    public function __construct(Project $project, Task $task)
    {
        parent::__construct($task->title);

        $this->addLink(new \App\Navigation\Link\Projects);
        $this->addLink(new \App\Navigation\Link\Projects\Show($project));
        $this->addLink(new \App\Navigation\Link\Projects\Tasks($project));
    }
}
