<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Drives extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.drives.index'), __('fileStore.drives'));
    }
}
