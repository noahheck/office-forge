<?php


namespace App\Html\LocationBar\Link\SystemSettings;


use App\Html\LocationBar\Link;

class Processes extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.processes.index'), __('admin.processes'));
    }
}
