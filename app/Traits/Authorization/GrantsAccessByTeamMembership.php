<?php


namespace App\Traits\Authorization;


use App\User;

trait GrantsAccessByTeamMembership
{
    public function isAccessibleBy(User $user)
    {
        $teams = $this->teams;

        if ($teams->count() < 1) {

            return true;
        }

        $userTeams = $user->teams;

        $sharedTeams = $teams->intersect($userTeams);

        return $sharedTeams->count() > 0;
    }
}
