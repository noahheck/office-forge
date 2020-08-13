<?php


namespace App\Authorization;


class Administrator
{
    public function __construct()
    {

    }

    public function authorize($user)
    {
        return $user->administrator;
    }
}
