<?php


namespace App\Navigation\Link\SystemSettings\Processes\Tasks;


use App\Navigation\Link;
use App\Process;
use App\Process\Task;

class Show extends Link
{
    public function __construct(Process $process, Task $task)
    {
        parent::__construct(route('admin.processes.tasks.show', [$process, $task]), $task->name);
    }
}
