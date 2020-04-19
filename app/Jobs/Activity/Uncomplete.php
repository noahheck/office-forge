<?php

namespace App\Jobs\Activity;

use App\Activity;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Uncomplete
{
    use Dispatchable, Queueable;

    private $activity;
    private $uncompletedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, User $uncompletedBy)
    {
        $this->activity = $activity;
        $this->uncompletedBy = $uncompletedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->activity->completed) {

            return;
        }

        $this->activity->completed = false;
        $this->activity->completed_at = null;
        $this->activity->completed_by = null;

        $this->activity->save();
    }
}
