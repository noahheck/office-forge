<?php


namespace App\Navigation\LocationBar;


use App\Navigation\LocationBar;

class Activity extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.userActivity'));
    }
}
