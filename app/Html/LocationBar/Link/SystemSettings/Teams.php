<?php


namespace App\Html\LocationBar\Link\SystemSettings;


use App\Html\LocationBar\Link;

class Teams extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.teams.index'), __('app.teams'));
    }
}
