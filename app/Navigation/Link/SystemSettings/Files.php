<?php


namespace App\Navigation\Link\SystemSettings;


use App\Navigation\Link;

class Files extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.files.index'), __('admin.files'));
    }
}
