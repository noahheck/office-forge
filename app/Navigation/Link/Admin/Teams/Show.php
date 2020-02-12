<?php


namespace App\Navigation\Link\Admin\Teams;


use App\Navigation\Link;
use App\Team;

class Show extends Link
{
    public function __construct(Team $team)
    {
        parent::__construct(route('admin.teams.show', [$team]), $team->name);
    }
}
