<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class FileTypes extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.file-types.index'), __('admin.file-types'));
    }
}
