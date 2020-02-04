<?php

namespace App\Jobs\Process\Instance;

use App\Process;
use App\Process\Instance;
use App\Process\Instance\Task as TaskInstance;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $process;
    private $name;
    private $details;
    private $owner_id;
    private $editor_temp_id;
    private $creator;

    private $instance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, $name, $details, $owner_id, $editor_temp_id, User $creator)
    {
        $this->process = $process;
        $this->name = $name;
        $this->details = $details;
        $this->owner_id = $owner_id;
        $this->editor_temp_id = $editor_temp_id;
        $this->creator = $creator;
    }

    public function getInstance(): Instance
    {
        return $this->instance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = $this->process;
        $instance = new Instance();

        $instance->process_id = $this->process->id;
        $instance->owner_id = $this->owner_id;
        $instance->process_name = $process->name;
        $instance->process_details = $process->details;
        $instance->name = $this->name;
        $instance->details = $this->details;
        $instance->active = true;
        $instance->completed = false;
        $instance->created_by = $this->creator->id;

        $instance->save();

        $instance->claimTemporaryEditorImages($this->editor_temp_id);

        $processTasks = $process->tasks()->where('active', true)->get();

        $tasks = $processTasks->map(function($task, $key) {
            $taskInstance = new TaskInstance();

            $taskInstance->process_task_id = $task->id;
            $taskInstance->task_name = $task->name;
            $taskInstance->task_details = $task->details;
            $taskInstance->order = $key + 1;

            return $taskInstance;
        });

        $instance->tasks()->saveMany($tasks);

        \Debugbar::info($tasks);


        $tasks->each(function($task, $key) use ($processTasks) {
            $taskTemplate = $processTasks->firstWhere('id', $task->process_task_id);

            \Debugbar::info($task);
            \Debugbar::info($taskTemplate);


        });

        $this->instance = $instance;
    }
}