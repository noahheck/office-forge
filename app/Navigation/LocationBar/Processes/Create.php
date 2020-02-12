<?php


namespace App\Navigation\LocationBar\Processes;


use App\Navigation\LocationBar;
use App\Process;

class Create extends LocationBar
{
    public function __construct(Process $process)
    {
        parent::__construct(__('app.new') . ' ' . $process->name);

        $this->addLink(new \App\Navigation\Link\Processes);

    }
}
