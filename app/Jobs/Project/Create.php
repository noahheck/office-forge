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
    public function __construct($name, $due_date, $details, $creator)
    {
        $this->name = $name;
        $this->due_date = $due_date;
        $this->details = $details;
        $this->creator = $creator;
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
        $project->details = $this->details;
        $project->created_by = $this->creator->id;

        if ($this->due_date) {
            $project->due_date = Carbon::parse($this->due_date);
        }

        $project->active = true;
        $project->completed = false;

        $project->save();

        $this->project = $project;
    }
}
