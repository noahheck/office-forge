<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class SystemSettings extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.index'), __('admin.systemSettings'));
    }
}
