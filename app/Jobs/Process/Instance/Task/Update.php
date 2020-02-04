<?php

namespace App\Jobs\Process\Instance\Task;

use App\Process\Instance\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $task;
    private $completed;
    private $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, $completed, $details)
    {
        $this->task = $task;
        $this->completed = $completed;
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

        $task->completed = $this->completed;
        $task->details = $this->details;

        $task->save();
    }
}
