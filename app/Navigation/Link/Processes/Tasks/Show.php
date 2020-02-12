<?php


namespace App\Navigation\Link\Processes\Tasks;


use App\Navigation\Link;
use App\Process\Instance;
use App\Process\Instance\Task;

class Show extends Link
{
    public function __construct(Instance $instance, Task $task)
    {
        parent::__construct(route('processes.tasks.show', [$instance, $task]), $task->task_name);
    }
}
