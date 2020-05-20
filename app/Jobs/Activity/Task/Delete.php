<?php

namespace App\Jobs\Activity\Task;

use App\Activity;
use App\Activity\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable, Queueable;

    /**
     * @var Task
     */
    private $task;

    private $deletedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, User $deletedBy)
    {
        $this->task = $task;
        $this->deletedBy = $deletedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->task->deleted_by = $this->deletedBy->id;
        $this->task->save();

        $this->task->delete();
    }
}
