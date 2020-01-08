<?php


namespace App\Navigation\LocationBar\Link\SystemSettings;


use App\Navigation\LocationBar\Link;

class Users extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.users.index'), __('admin.users'));
    }
}
