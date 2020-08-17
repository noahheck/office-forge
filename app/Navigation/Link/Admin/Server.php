<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Server extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.server'), __('admin.server'));
    }
}
