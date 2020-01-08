<?php


namespace App\Html\LocationBar\Link;


use App\Html\LocationBar\Link;

class SystemSettings extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.index'), __('admin.systemSettings'));
    }
}
