<?php

namespace App\Jobs\Process\Task\Actions;

use App\Process;
use App\Process\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $process;
    private $task;
    private $orderedActionIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, Task $task, $orderedActionIds)
    {
        $this->process = $process;
        $this->task = $task;
        $this->orderedActionIds = $orderedActionIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $actionOrderMap = array_flip($this->orderedActionIds);

        $actions = $this->task->actions;

        foreach ($actions as $action) {
            $action->order = $actionOrderMap[$action->id] + 1;
            $action->save();
        }
    }
}
