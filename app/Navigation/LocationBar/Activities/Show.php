<?php


namespace App\Navigation\LocationBar\Activities;


use App\Activity;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(Activity $activity)
    {
        $name = $activity->process_name;

        $name .= ($name) ? ' - ' . $activity->name : $activity->name;

        parent::__construct($name);

        $this->addLink(new \App\Navigation\Link\Activities);
    }
}
