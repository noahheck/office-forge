<?php


namespace App\Activity;


use App\Activity;
use App\File;
use App\User;

class ActivityProvider
{
    /**
     * @var Activity
     */
    private $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function getOpenActivitiesForUser(User $user)
    {
        $ownedActivities = $user->openOwnedActivities;

        $participatingActivities = $this->activity->where('completed', false)->whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', '=', $user->id);
        })->get();

        $allActivities = $ownedActivities->merge($participatingActivities)->unique()->sortBy('due_date');

        return $allActivities;
    }

    public function getAllActivitiesForUser(User $user)
    {
        $ownedActivities = $user->ownedActivities;

        $participatingActivities = $this->activity->whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', '=', $user->id);
        })->get();

        $allActivities = $ownedActivities->merge($participatingActivities)->unique()->sortBy('due_date');

        return $allActivities;
    }

    public function getOpenActivitiesForFile(File $file)
    {
        return $file->activities()->where('completed', false)->get();
    }

    public function getAllActivitiesForFile(File $file)
    {
        return $file->activities;
    }
}
