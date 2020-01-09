<?php


namespace App\Navigation\LocationBar\Link\SystemSettings\Processes;


use App\Navigation\LocationBar\Link;
use App\Process;

class Show extends Link
{
    public function __construct(Process $process)
    {
        parent::__construct(route('admin.processes.show', [$process]), $process->name);
    }
}
