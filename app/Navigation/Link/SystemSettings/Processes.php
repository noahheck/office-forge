<?php


namespace App\Navigation\Link\SystemSettings;


use App\Navigation\Link;

class Processes extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.processes.index'), __('admin.processes'));
    }
}
