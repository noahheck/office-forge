<?php


namespace App\Navigation\LocationBar\Processes\Tasks\Actions;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;
use App\Process\Instance\Task;
use App\Process\Instance\Task\Action;

class Edit extends LocationBar
{
    public function __construct(Process $process, Instance $instance, Task $task, Action $action)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Processes());
        $this->addLink(new \App\Navigation\Link\Processes\Show($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Show($instance, $task));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Actions($instance, $task));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Actions\Show($instance, $task, $action));
    }
}
