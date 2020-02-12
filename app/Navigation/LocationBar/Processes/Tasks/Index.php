<?php


namespace App\Navigation\LocationBar\Processes\Tasks;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;

class Index extends LocationBar
{
    public function __construct(Process $process, Instance $instance)
    {
        parent::__construct(__('process.tasks'));

        $this->addLink(new \App\Navigation\Link\Processes());
        $this->addLink(new \App\Navigation\Link\Processes\Show($instance));
    }
}
