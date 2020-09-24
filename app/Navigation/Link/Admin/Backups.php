<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Backups extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.backups'), __('admin.backups'));
    }
}
