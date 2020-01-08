<?php


namespace App\Navigation\LocationBar\Link\SystemSettings;


use App\Navigation\LocationBar\Link;

class Teams extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.teams.index'), __('app.teams'));
    }
}
