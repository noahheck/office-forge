<?php


namespace App\Navigation\Link\Activities\Tasks;


use App\Navigation\Link;
use App\Activity\Task;

class Show extends Link
{
    public function __construct(Task $task)
    {
        parent::__construct(route('activities.tasks.show', [$task->activity, $task]), $task->title);
    }
}
