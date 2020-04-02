<?php


namespace App\Navigation\LocationBar\Activities\Tasks;


use App\Navigation\LocationBar;
use App\Project;
use App\Project\Task;

class Show extends LocationBar
{
    public function __construct(Project $project, Task $task)
    {
        parent::__construct($task->title);

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($project));
        $this->addLink(new \App\Navigation\Link\Activities\Tasks($project));
    }
}
