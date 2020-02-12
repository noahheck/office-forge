<?php


namespace App\Navigation\LocationBar\Admin\Users;


use App\Navigation\LocationBar;
use App\User;

class Show extends LocationBar
{
    public function __construct(User $user)
    {
        parent::__construct($user->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Users);
    }
}
