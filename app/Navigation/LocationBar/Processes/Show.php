<?php


namespace App\Navigation\LocationBar\Processes;


use App\Navigation\LocationBar;
use App\Process;
use App\Process\Instance;

class Show extends LocationBar
{
    public function __construct(Process $process, Instance $instance)
    {
        parent::__construct($instance->fullName);

        $this->addLink(new \App\Navigation\Link\Processes);

    }
}
