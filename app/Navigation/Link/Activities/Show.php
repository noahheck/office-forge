<?php


namespace App\Navigation\Link\Activities;


use App\Activity;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Activity $activity)
    {
        $name = $activity->process_name;

        $name .= ($name) ? ' - ' . $activity->name : $activity->name;

        parent::__construct(route('activities.show', [$activity]), $name);
    }
}
