<?php


namespace App\Navigation\LocationBar\Admin\Processes;


use App\Navigation\LocationBar;
use App\Process;

class Show extends LocationBar
{
    public function __construct(Process $process)
    {
        parent::__construct($process->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Processes);
    }
}
