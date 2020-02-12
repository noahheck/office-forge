<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class Processes extends Link
{
    public function __construct()
    {
        parent::__construct(route('processes.index'), __('app.processes'));
    }
}
