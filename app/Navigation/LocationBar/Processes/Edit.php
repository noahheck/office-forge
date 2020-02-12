<?php


namespace App\Navigation\LocationBar\Processes;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;

class Edit extends LocationBar
{
    public function __construct(Process $process, Instance $instance)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Processes);
        $this->addLink(new \App\Navigation\Link\Processes\Show($instance));

    }
}
