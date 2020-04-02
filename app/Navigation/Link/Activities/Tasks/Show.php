<?php


namespace App\Navigation\Link\Activities\Tasks;


use App\Navigation\Link;
use App\Project\Task;

class Show extends Link
{
    public function __construct(Task $task)
    {
        parent::__construct(route('projects.tasks.show', [$task->project, $task]), $task->title);
    }
}
