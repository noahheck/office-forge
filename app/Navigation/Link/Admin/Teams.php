<?php


namespace App\Navigation\Link\Admin;


use App\Navigation\Link;

class Teams extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.teams.index'), __('app.teams'));
    }
}
