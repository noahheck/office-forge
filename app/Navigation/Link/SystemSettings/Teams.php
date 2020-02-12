<?php


namespace App\Navigation\Link\SystemSettings;


use App\Navigation\Link;

class Teams extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.teams.index'), __('app.teams'));
    }
}
