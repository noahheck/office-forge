<?php

namespace App\Jobs\Activity;

use App\Activity;
use App\User;
use Illuminate\Bus\Queueable;
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
    public function handle()
    {
        $this->activity->delete();
    }
}
