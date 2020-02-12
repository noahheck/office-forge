<?php


namespace App\Navigation\LocationBar\Processes\Tasks\Actions;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;
use App\Process\Instance\Task;
use App\Process\Instance\Task\Action;

class Show extends LocationBar
{
    public function __construct(Process $process, Instance $instance, Task $task, Action $action)
    {
        parent::__construct($action->action_name);

        $this->addLink(new \App\Navigation\Link\Processes());
        $this->addLink(new \App\Navigation\Link\Processes\Show($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Show($instance, $task));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Actions($instance, $task));
    }
}
