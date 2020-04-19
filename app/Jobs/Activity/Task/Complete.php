<?php

namespace App\Jobs\Activity\Task;

use App\Activity\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Complete
{
    use Dispatchable, Queueable;

    private $task;
    private $completedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, User $completedBy)
    {
        $this->task = $task;
        $this->completedBy = $completedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->task->completed) {

            return;
        }

        $this->task->completed = true;
        $this->task->completed_at = now();
        $this->task->completed_by = $this->completedBy->id;

        $this->task->save();
    }
}
