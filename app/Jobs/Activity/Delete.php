<?php

namespace App\Jobs\Activity;

use App\Activity;
use App\User;
use App\Jobs\Activity\Task\Delete as DeleteTask;
use App\Jobs\FormDoc\Delete as DeleteFormDoc;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable, Queueable;

    private $activity;
    private $deletedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, User $deletedBy)
    {
        $this->activity = $activity;
        $this->deletedBy = $deletedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Dispatcher $dispatcher)
    {
        $tasks = $this->activity->tasks;
        $formDocs = $this->activity->formDocs;

        $this->activity->deleted_by = $this->deletedBy->id;
        $this->activity->save();
        $this->activity->delete();

        foreach ($tasks as $task) {
            $dispatcher->dispatchNow(new DeleteTask($task, $this->deletedBy));
        }

        foreach ($formDocs as $formDoc) {
            $dispatcher->dispatchNow(new DeleteFormDoc($formDoc, $this->deletedBy));
        }
    }
}
