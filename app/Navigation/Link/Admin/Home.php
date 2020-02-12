<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Home extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.index'), __('admin.systemSettings'));
    }
}
