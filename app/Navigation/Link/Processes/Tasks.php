<?php


namespace App\Navigation\Link\Processes;


use App\Navigation\Link;
use App\Process\Instance;

class Tasks extends Link
{
    public function __construct(Instance $instance)
    {
        parent::__construct(route('processes.tasks.index', [$instance]), __('process.tasks'));
    }
}
