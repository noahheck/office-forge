<?php


namespace App\Navigation\Link\Activities;


use App\Activity;
use App\Navigation\Link;

class Tasks extends Link
{
    public function __construct(Activity $activity)
    {
        parent::__construct(route('activities.tasks.index', [$activity]), __('activity.tasks'));
    }
}
