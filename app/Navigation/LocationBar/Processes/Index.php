<?php


namespace App\Navigation\LocationBar\Processes;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.processes'));
    }
}
