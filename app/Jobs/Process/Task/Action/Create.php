<?php

namespace App\Jobs\Process\Task\Action;

use App\Process;
use App\Process\Task;
use App\Process\Task\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $process;
    private $task;
    private $name;
    private $details;
    private $editor_temp_id;

    private $action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, Task $task, $name, $details, $editor_temp_id)
    {
        $this->process = $process;
        $this->task = $task;
        $this->name = $name;
        $this->details = $details;
        $this->editor_temp_id = $editor_temp_id;
    }

    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $action          = new Action;
        $action->task_id = $this->task->id;
        $action->name    = $this->name;
        $action->details = $this->details;
        $action->active  = true;

        $maxOrder = $this->task->actions->max('order');
        $action->order = ($maxOrder ?? 0) + 1;

        $action->save();

        $action->claimTemporaryEditorImages($this->editor_temp_id);

        $this->action = $action;
    }
}
