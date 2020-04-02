<?php

namespace App\Jobs\Activity;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $name;
    private $due_date;
    private $owner_id;
    private $completed;
    private $details;
    private $creator;

    /**
     * @var Activity
     */
    private $activity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, $name, $due_date, $owner_id, $completed, $details)
    {
        $this->activity = $activity;
        $this->name = $name;
        $this->due_date = $due_date;
        $this->owner_id = $owner_id;
        $this->completed = $completed;
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $activity = $this->activity;
        $activity->name = $this->name;
        $activity->details = $this->details;
        $activity->owner_id = $this->owner_id;

        $activity->due_date = null;
        if ($this->due_date) {
            $activity->due_date = Carbon::parse($this->due_date);
        }

        $activity->active = true;

        $activity->completed = $this->completed;

        $activity->save();
    }
}
