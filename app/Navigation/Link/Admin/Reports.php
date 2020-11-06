<?php


namespace App\Navigation\Link\Admin;


use App\FileType;
use App\Navigation\Link;

class Reports extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.reports.index'), __('app.reports'));
    }
}
