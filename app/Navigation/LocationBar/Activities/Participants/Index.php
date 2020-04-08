<?php


namespace App\Navigation\LocationBar\Activities\Participants;


use App\Activity;
use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct(Activity $activity)
    {
        parent::__construct(__('activity.participants'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($activity));
    }
}
