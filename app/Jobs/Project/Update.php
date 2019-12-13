<?php

namespace App\Jobs\Project;

use App\Project;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $name;
    private $due_date;
    private $completed;
    private $details;
    private $creator;

    /**
     * @var Project
     */
    private $project;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project, $name, $due_date, $completed, $details)
    {
        $this->project = $project;
        $this->name = $name;
        $this->due_date = $due_date;
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
        $project = $this->project;
        $project->name = $this->name;
        $project->details = $this->details;

        $project->due_date = null;
        if ($this->due_date) {
            $project->due_date = Carbon::parse($this->due_date);
        }

        $project->active = true;

        $project->completed = $this->completed;

        $project->save();
    }
}
