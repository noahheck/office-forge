<?php

namespace App\Jobs\Process\Task\Action;

use App\Process;
use App\Process\Task;
use App\Process\Task\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $process;
    private $task;
    private $action;
    private $name;
    private $active;
    private $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, Task $task, Action $action, $name, $active, $details)
    {
        $this->process = $process;
        $this->task = $task;
        $this->action = $action;
        $this->name = $name;
        $this->active = $active;
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $action = $this->action;

        $action->name = $this->name;
        $action->active = $this->active;
        $action->details = $this->details;

        $action->save();
    }
}
