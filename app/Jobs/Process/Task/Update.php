<?php

namespace App\Jobs\Process\Task;

use App\Process;
use App\Process\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $process;
    private $task;
    private $name;
    private $active;
    private $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, Task $task, $name, $active, $details)
    {
        $this->process = $process;
        $this->task = $task;
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
        $task = $this->task;

        $task->name = $this->name;
        $task->active = $this->active;
        $task->details = $this->details;

        $task->save();
    }
}
