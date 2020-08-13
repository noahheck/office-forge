<?php


namespace App\Authorization;


class SharedTeamMembership
{
    public function __construct()
    {

    }

    public function authorize($user, $item)
    {
        $itemTeams = $item->teams;

        if ($itemTeams->count() < 1) {

            return true;
        }

        $userTeams = $user->teams;

        $sharedTeams = $itemTeams->intersect($userTeams);

        return $sharedTeams->count() > 0;
    }
}
