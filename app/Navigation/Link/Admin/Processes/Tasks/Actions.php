<?php


namespace App\Navigation\Link\Admin\Processes\Tasks;


use App\Navigation\Link;
use App\Process;
use App\Process\Task;

class Actions extends Link
{
    public function __construct(Process $process, Task $task)
    {
        parent::__construct(route('admin.processes.tasks.actions.index', [$process, $task]), __('process.actions'));
    }
}
