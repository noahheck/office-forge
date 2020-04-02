<?php


namespace App\Navigation\LocationBar\Activities\Tasks;


use App\Activity;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(Activity $activity)
    {
        parent::__construct(__('activity.tasks'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($activity));
    }
}
