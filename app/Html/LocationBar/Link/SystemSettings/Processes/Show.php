<?php


namespace App\Html\LocationBar\Link\SystemSettings\Processes;


use App\Html\LocationBar\Link;
use App\Process;

class Show extends Link
{
    public function __construct(Process $process)
    {
        parent::__construct(route('admin.processes.show', [$process]), e($process->name));
    }
}
