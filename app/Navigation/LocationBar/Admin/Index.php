<?php


namespace App\Navigation\LocationBar\Admin;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.systemSettings'));
    }
}
