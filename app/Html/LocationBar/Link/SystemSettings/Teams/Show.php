<?php


namespace App\Html\LocationBar\Link\SystemSettings\Teams;


use App\Html\LocationBar\Link;
use App\Team;
use App\User;

class Show extends Link
{
    public function __construct(Team $team)
    {
        parent::__construct(route('admin.teams.show', [$team]), e($team->name));
    }
}
