<?php

namespace App\Jobs\Process\Task;

use App\Process;
use App\Process\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $process;
    private $name;
    private $details;
    private $editor_temp_id;

    private $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, $name, $details, $editor_temp_id)
    {
        $this->process = $process;
        $this->name = $name;
        $this->details = $details;
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
        $task             = new Task;
        $task->process_id = $this->process->id;
        $task->name       = $this->name;
        $task->details    = $this->details;
        $task->active     = true;

        $maxOrder = $this->process->tasks->max('order');
        $task->order = ($maxOrder ?? 0) + 1;

        $task->save();

        $task->claimTemporaryEditorImages($this->editor_temp_id);

        $this->task = $task;
    }
}
