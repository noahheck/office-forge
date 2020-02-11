<?php


namespace App\Navigation\LocationBar\Link\SystemSettings;


use App\Navigation\LocationBar\Link;

class Files extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.files.index'), __('admin.files'));
    }
}
