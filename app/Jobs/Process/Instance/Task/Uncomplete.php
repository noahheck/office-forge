<?php

namespace App\Jobs\Process\Instance\Task;

use App\Process\Instance\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Uncomplete
{
    use Dispatchable, Queueable;

    private $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->task->completed = false;

        $this->task->save();
    }
}
