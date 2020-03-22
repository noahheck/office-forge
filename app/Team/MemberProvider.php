<?php


namespace App\Team;


use App\User;
use App\Team as Team;

class MemberProvider
{

    public function membersOfTeam($teamId = '')
    {
        if (!$teamId) {

            return User::ordered()->get();
        }

        return Team::find($teamId)->members;
    }
}
