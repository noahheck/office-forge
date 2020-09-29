<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Logs extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.logs'), __('admin.logs'));
    }
}
