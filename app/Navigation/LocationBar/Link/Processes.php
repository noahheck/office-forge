<?php


namespace App\Navigation\LocationBar\Link;


use App\Navigation\LocationBar\Link;

class Processes extends Link
{
    public function __construct()
    {
        parent::__construct(route('processes.index'), __('app.processes'));
    }
}
