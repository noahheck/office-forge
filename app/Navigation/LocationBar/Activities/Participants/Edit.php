<?php


namespace App\Navigation\LocationBar\Activities\Participants;


use App\Navigation\LocationBar;
use App\Activity;
use App\Activity\Task;

class Edit extends LocationBar
{
    public function __construct(Activity $activity)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($activity));
        $this->addLink(new \App\Navigation\Link\Activities\Participants($activity));
    }
}
