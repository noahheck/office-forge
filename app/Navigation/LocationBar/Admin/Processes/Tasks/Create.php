<?php


namespace App\Navigation\LocationBar\Admin\Processes\Tasks;


use App\Navigation\LocationBar;
use App\Process;

class Create extends LocationBar
{
    public function __construct(Process $process)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Processes());
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Show($process));
        $this->addLink(new \App\Navigation\Link\Admin\Processes\Tasks($process));
    }
}
