<?php


namespace App\Navigation\LocationBar\Processes\Tasks\Actions;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;
use App\Process\Instance\Task;

class Index extends LocationBar
{
    public function __construct(Process $process, Instance $instance, Task $task)
    {
        parent::__construct(__('process.actions'));

        $this->addLink(new \App\Navigation\Link\Processes());
        $this->addLink(new \App\Navigation\Link\Processes\Show($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Show($instance, $task));
    }
}
