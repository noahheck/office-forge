<?php

namespace App\Jobs\Activity;

use App\Activity;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Complete
{
    use Dispatchable, Queueable;

    private $activity;
    private $completedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, User $completedBy)
    {
        $this->activity = $activity;
        $this->completedBy = $completedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->activity->completed) {

            return;
        }

        $this->activity->completed = true;
        $this->activity->completed_at = now();
        $this->activity->completed_by = $this->completedBy->id;

        $this->activity->save();
    }
}
