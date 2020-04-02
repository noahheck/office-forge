<?php


namespace App\Navigation\LocationBar\Activities\Tasks;


use App\Navigation\LocationBar;
use App\Activity;
use App\Activity\Task;

class Edit extends LocationBar
{
    public function __construct(Activity $activity, Task $task)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($activity));
        $this->addLink(new \App\Navigation\Link\Activities\Tasks($activity));
        $this->addLink(new \App\Navigation\Link\Activities\Tasks\Show($task));
    }
}
