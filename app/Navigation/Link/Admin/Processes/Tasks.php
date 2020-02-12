<?php


namespace App\Navigation\Link\Admin\Processes;


use App\Navigation\Link;
use App\Process;

class Tasks extends Link
{
    public function __construct(Process $process)
    {
        parent::__construct(route('admin.processes.tasks.index', [$process]), __('admin.tasks'));
    }
}
