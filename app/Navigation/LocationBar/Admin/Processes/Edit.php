<?php


namespace App\Navigation\LocationBar\Admin\Processes;


use App\Navigation\LocationBar;
use App\Process;

class Edit extends LocationBar
{
    public function __construct(Process $process)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Processes);
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Show($process));
    }
}
