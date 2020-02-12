<?php


namespace App\Navigation\LocationBar\Admin\Teams;


use App\Navigation\LocationBar;
use App\Team;

class Show extends LocationBar
{
    public function __construct(Team $team)
    {
        parent::__construct($team->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Teams);
    }
}
