<?php


namespace App\Navigation\Link\Admin\Users;


use App\Navigation\Link;
use App\User;

class Show extends Link
{
    public function __construct(User $user)
    {
        parent::__construct(route('admin.users.show', [$user]), $user->name);
    }
}
