<?php

namespace App\Jobs\Project;

use App\Project;
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

    /**
     * @var Project
     */
    private $project;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $due_date, $owner_id, $details, $creator, $editor_temp_id)
    {
        $this->name = $name;
        $this->due_date = $due_date;
        $this->owner_id = $owner_id;
        $this->details = $details;
        $this->creator = $creator;
        $this->editor_temp_id = $editor_temp_id;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $project = new Project;
        $project->name = $this->name;
        $project->owner_id = $this->owner_id;
        $project->details = $this->details;
        $project->created_by = $this->creator->id;

        if ($this->due_date) {
            $project->due_date = Carbon::parse($this->due_date);
        }

        $project->active = true;

        $project->save();

        $project->claimTemporaryEditorImages($this->editor_temp_id);

        $this->project = $project;
    }
}
