<?php

namespace App\Jobs\Activity;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $due_date;
    private $owner_id;
    private $details;
    private $creator;
    private $editor_temp_id;
    private $file_id;

    /**
     * @var Activity
     */
    private $activity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $due_date, $owner_id, $details, $creator, $editor_temp_id, $file_id = false)
    {
        $this->name = $name;
        $this->due_date = $due_date;
        $this->owner_id = $owner_id;
        $this->details = $details;
        $this->creator = $creator;
        $this->editor_temp_id = $editor_temp_id;
        $this->file_id = $file_id;
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $activity = new Activity;
        $activity->name = $this->name;
        $activity->owner_id = $this->owner_id;
        $activity->details = $this->details;
        $activity->created_by = $this->creator->id;

        $activity->active = true;

        if ($this->due_date) {
            $activity->due_date = Carbon::parse($this->due_date);
        }

        if ($this->file_id) {
            $activity->file_id = $this->file_id;
        }

        $activity->save();

        $activity->claimTemporaryEditorImages($this->editor_temp_id);

        $this->activity = $activity;
    }
}
