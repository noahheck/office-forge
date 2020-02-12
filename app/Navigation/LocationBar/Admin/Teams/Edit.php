<?php


namespace App\Navigation\LocationBar\Admin\Teams;


use App\Navigation\LocationBar;
use App\Team;

class Edit extends LocationBar
{
    public function __construct(Team $team)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Teams);
        $this->addLink(new \App\Navigation\Link\Admin\Teams\Show($team));
    }
}
