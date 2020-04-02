<?php

namespace App\Jobs\Activity\Task;

use App\Project;
use App\Project\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    /**
     * @var Task
     */
    private $task;

    private $title;
    private $due_date;
    private $assigned_to;
    private $completed;
    private $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, $title, $due_date, $assigned_to, $completed, $details)
    {
        $this->task = $task;
        $this->title = $title;
        $this->due_date = $due_date;
        $this->assigned_to = $assigned_to;
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

        $task->title = $this->title;
        $task->details = $this->details;
        $task->assigned_to = $this->assigned_to;

        $task->due_date = null;
        if ($this->due_date) {
            $task->due_date = Carbon::parse($this->due_date);
        }

        $task->completed = $this->completed;

        $task->save();
    }
}
