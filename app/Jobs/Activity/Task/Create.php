<?php

namespace App\Jobs\Activity\Task;

use App\Activity;
use App\Activity\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    /**
     * @var Task
     */
    private $task;

    private $activity;
    private $title;
    private $due_date;
    private $assigned_to;
    private $details;
    private $creator;
    private $editor_temp_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, $title, $due_date, $assigned_to, $details, User $creator, $editor_temp_id)
    {
        $this->activity = $activity;
        $this->title = $title;
        $this->due_date = $due_date;
        $this->assigned_to = $assigned_to;
        $this->details = $details;
        $this->creator = $creator;
        $this->editor_temp_id = $editor_temp_id;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $task = new Task();

        $task->activity_id = $this->activity->id;
        $task->title = $this->title;
        $task->assigned_to = $this->assigned_to;
        $task->details = $this->details;
        $task->created_by = $this->creator->id;
        $task->order = $this->activity->tasks->max('order') + 1;

        if ($this->due_date) {
            $task->due_date = Carbon::parse($this->due_date);
        }

        $task->save();

        $task->claimTemporaryEditorImages($this->editor_temp_id);

        $this->task = $task;
    }
}
