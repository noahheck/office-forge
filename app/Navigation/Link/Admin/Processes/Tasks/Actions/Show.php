<?php


namespace App\Navigation\Link\Admin\Processes\Tasks\Actions;


use App\Navigation\Link;
use App\Process;
use App\Process\Task;
use App\Process\Task\Action;

class Show extends Link
{
    public function __construct(Process $process, Task $task, Action $action)
    {
        parent::__construct(route('admin.processes.tasks.actions.show', [$process, $task, $action]), $action->name);
    }
}
