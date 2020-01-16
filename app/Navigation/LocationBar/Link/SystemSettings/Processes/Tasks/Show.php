<?php


namespace App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks;


use App\Navigation\LocationBar\Link;
use App\Process;
use App\Process\Task;

class Show extends Link
{
    public function __construct(Process $process, Task $task)
    {
        parent::__construct(route('admin.processes.tasks.show', [$process, $task]), $task->name);
    }
}
