<?php

namespace App\Jobs\Activity\Task;

use App\Activity\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Uncomplete
{
    use Dispatchable, Queueable;

    private $task;
    private $completedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, User $uncompletedBy)
    {
        $this->task = $task;
        $this->uncompletedBy = $uncompletedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->task->completed) {

            return;
        }

        $this->task->completed = false;
        $this->task->completed_at = null;
        $this->task->completed_by = null;

        $this->task->save();
    }
}
