<?php


namespace App\Navigation\LocationBar\Admin\Processes\Tasks;


use App\Navigation\LocationBar;
use App\Process;

class Index extends LocationBar
{
    public function __construct(Process $process)
    {
        parent::__construct(__('process.tasks'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Processes());
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Show($process));
    }
}
