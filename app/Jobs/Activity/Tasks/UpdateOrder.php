<?php

namespace App\Jobs\Activity\Tasks;

use App\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $activity;
    private $orderedTaskIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, $orderedTaskIds)
    {
        $this->activity = $activity;
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

        $tasks = $this->activity->openTasks;

        foreach ($tasks as $task) {
            $task->order = $taskOrderMap[$task->id] + 1;
            $task->save();
        }
    }
}
