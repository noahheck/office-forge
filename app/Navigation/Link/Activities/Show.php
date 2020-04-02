<?php


namespace App\Navigation\Link\Activities;


use App\Activity;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Activity $activity)
    {
        parent::__construct(route('activities.show', [$activity]), $activity->name);
    }
}
