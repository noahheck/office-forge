<?php


namespace App\Navigation\LocationBar\Link\SystemSettings;


use App\Navigation\LocationBar\Link;

class Processes extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.processes.index'), __('admin.processes'));
    }
}
