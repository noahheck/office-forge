<?php


namespace App\Navigation\LocationBar\Admin\Processes\Tasks\Actions;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Task;
use App\Process\Task\Action;

class Show extends LocationBar
{
    public function __construct(Process $process, Task $task, Action $action)
    {
        parent::__construct($action->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Processes());
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Show($process));
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Tasks($process));
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Tasks\Show($process, $task));
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Tasks\Actions($process, $task));
    }
}
