<?php


namespace App\Navigation\LocationBar\Link;


use App\Navigation\LocationBar\Link;

class SystemSettings extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.index'), __('admin.systemSettings'));
    }
}
