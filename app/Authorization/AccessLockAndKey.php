<?php


namespace App\Authorization;


class AccessLockAndKey
{
    public function __construct()
    {

    }

    public function authorize($user, $item)
    {
        $itemLocks = $item->accessLocks;

        if ($itemLocks->count() < 1) {

            return true;
        }

        $accessKeys = $user->accessKeys;

        return $itemLocks->intersect($accessKeys)->count() > 0;
    }
}
