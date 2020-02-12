<?php


namespace App\Navigation\Link\Admin\Processes;


use App\Navigation\Link;
use App\Process;

class Show extends Link
{
    public function __construct(Process $process)
    {
        parent::__construct(route('admin.processes.show', [$process]), $process->name);
    }
}
