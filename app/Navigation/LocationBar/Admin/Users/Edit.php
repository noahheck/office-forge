<?php


namespace App\Navigation\LocationBar\Admin\Users;


use App\Navigation\LocationBar;
use App\User;

class Edit extends LocationBar
{
    public function __construct(User $user)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Users);
        $this->addLink(new \App\Navigation\Link\Admin\Users\Show($user));
    }
}
