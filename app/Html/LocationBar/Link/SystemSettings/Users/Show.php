<?php


namespace App\Html\LocationBar\Link\SystemSettings\Users;


use App\Html\LocationBar\Link;
use App\User;

class Show extends Link
{
    public function __construct(User $user)
    {
        parent::__construct(route('admin.users.show', [$user]), e($user->name));
    }
}
