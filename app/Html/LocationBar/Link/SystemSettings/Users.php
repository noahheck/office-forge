<?php


namespace App\Html\LocationBar\Link\SystemSettings;


use App\Html\LocationBar\Link;

class Users extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.users.index'), __('admin.users'));
    }
}
