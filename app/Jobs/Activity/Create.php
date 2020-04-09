<?php

namespace App\Jobs\Activity;

use App\Activity;
use App\Activity\Task;
use App\Process;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $due_date;
    private $owner_id;
    private $private;
    private $details;
    private $creator;
    private $editor_temp_id;
    private $file_id;
    private $process_id;

    /**
     * @var Activity
     */
    private $activity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $name,
        $due_date,
        $owner_id,
        $private,
        $details,
        $creator,
        $editor_temp_id,
        $file_id = false,
        $process_id = false
    ) {
        $this->name = $name;
        $this->due_date = $due_date;
        $this->owner_id = $owner_id;
        $this->private = $private;
        $this->details = $details;
        $this->creator = $creator;
        $this->editor_temp_id = $editor_temp_id;
        $this->file_id = $file_id;
        $this->process_id = $process_id;
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Process $processModel)
    {
        $activity = new Activity;
        $activity->name = $this->name;
        $activity->owner_id = $this->owner_id;
        $activity->private = $this->private;
        $activity->details = $this->details;
        $activity->created_by = $this->creator->id;

        $activity->active = true;

        if ($this->due_date) {
            $activity->due_date = Carbon::parse($this->due_date);
        }

        if ($this->file_id) {
            $activity->file_id = $this->file_id;
        }

        $process = false;

        if ($this->process_id) {
            $activity->process_id = $this->process_id;

            $process = $processModel->find($this->process_id);

            $activity->process_name = $process->name;
            $activity->process_details = $process->details;
        }


        $activity->save();

        $activity->claimTemporaryEditorImages($this->editor_temp_id);

        if ($process) {
            foreach ($process->activeTasks as $taskTemplate) {
                $task = new Task();
                $task->process_task_id = $taskTemplate->id;
                $task->title = $taskTemplate->name;
                $task->process_task_details = $taskTemplate->details;

                $task->activity_id = $activity->id;
                $task->created_by = $this->creator->id;

                $task->save();
            }
        }

        $this->activity = $activity;
    }
}
