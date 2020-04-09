<?php


namespace App\Navigation\Link\Activities;


use App\Activity;
use App\Navigation\Link;

class Participants extends Link
{
    public function __construct(Activity $activity)
    {
        parent::__construct(route('activities.participants.index', [$activity]), __('activity.participants'));
    }
}
