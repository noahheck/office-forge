<?php

namespace App\Jobs\Process\Tasks;

use App\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $process;
    private $orderedTaskIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, $orderedTaskIds)
    {
        $this->process = $process;
        $this->orderedTaskIds = $orderedTaskIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $taskOrderMap = array_flip($this->orderedTaskIds);

        $tasks = $this->process->tasks;

        foreach ($tasks as $task) {
            $task->order = $taskOrderMap[$task->id] + 1;
            $task->save();
        }
    }
}
