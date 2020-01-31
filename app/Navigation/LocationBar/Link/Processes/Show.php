<?php


namespace App\Navigation\LocationBar\Link\Processes;


use App\Navigation\LocationBar\Link;
use App\Process\Instance;

class Show extends Link
{
    public function __construct(Instance $instance)
    {
        parent::__construct(route('processes.show', [$instance]), $instance->process_name . ' - ' .  $instance->name);
    }
}
