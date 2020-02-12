<?php


namespace App\Navigation\LocationBar\Processes\Tasks;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;
use App\Process\Instance\Task;

class Edit extends LocationBar
{
    public function __construct(Process $process, Instance $instance, Task $task)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Processes());
        $this->addLink(new \App\Navigation\Link\Processes\Show($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks($instance));
        $this->addLink(new \App\Navigation\Link\Processes\Tasks\Show($instance, $task));
    }
}
