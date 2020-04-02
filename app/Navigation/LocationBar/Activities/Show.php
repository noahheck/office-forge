<?php


namespace App\Navigation\LocationBar\Activities;


use App\Activity;
use App\Navigation\LocationBar;
use App\Project;

class Show extends LocationBar
{
    public function __construct(Activity $activity)
    {
        parent::__construct($activity->name);

        $this->addLink(new \App\Navigation\Link\Activities);
    }
}
