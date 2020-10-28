<?php


namespace App\Authorization;


class SharedTeamMembership
{
    public function __construct()
    {

    }

    public function authorize($user, $item, $teamCollectionAccessor = 'teams')
    {
        // We evaluate unrestrictedness (tm) by the absence of any team restrictions (regardless of accessor method)
        $itemTeams = $item->teams;

        // Unrestricted
        if ($itemTeams->count() < 1) {

            return true;
        }

        if ($teamCollectionAccessor !== 'teams') {

            $itemTeams = $item->$teamCollectionAccessor;
        }

        $userTeams = $user->teams;

        $sharedTeams = $itemTeams->intersect($userTeams);

        return $sharedTeams->count() > 0;
    }
}
