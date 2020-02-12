<?php


namespace App\Navigation\Link\Processes;


use App\Navigation\Link;
use App\Process\Instance;

class Show extends Link
{
    public function __construct(Instance $instance)
    {
        parent::__construct(route('processes.show', [$instance]), $instance->process_name . ' - ' .  $instance->name);
    }
}
