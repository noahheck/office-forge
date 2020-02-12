<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Users extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.users.index'), __('admin.users'));
    }
}
