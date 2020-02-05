<?php


namespace App\Navigation\LocationBar\Link\Processes\Tasks\Actions;


use App\Navigation\LocationBar\Link;
use App\Process\Instance;
use App\Process\Instance\Task;
use App\Process\Instance\Task\Action;

class Show extends Link
{
    public function __construct(Instance $instance, Task $task, Action $action)
    {
        parent::__construct(route('processes.tasks.actions.show', [$instance, $task, $action]), $action->action_name);
    }
}
