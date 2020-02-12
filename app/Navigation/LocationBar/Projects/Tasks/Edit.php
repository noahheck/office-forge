<?php


namespace App\Navigation\LocationBar\Projects\Tasks;


use App\Navigation\LocationBar;
use App\Project;
use App\Project\Task;

class Edit extends LocationBar
{
    public function __construct(Project $project, Task $task)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Projects);
        $this->addLink(new \App\Navigation\Link\Projects\Show($project));
        $this->addLink(new \App\Navigation\Link\Projects\Tasks($project));
        $this->addLink(new \App\Navigation\Link\Projects\Tasks\Show($task));
    }
}
