<?php

namespace App\Jobs\Report;

use App\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $description;
    private $active;
    private $teams;

    private $report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $description, $active, $teams)
    {
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
        $this->teams = $teams;
    }

    public function getReport(): Report
    {
        return $this->report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = new Report;
        $report->name = $this->name;
        $report->description = $this->description;
        $report->active = $this->active;

        $report->save();

        $report->teams()->sync($this->teams);

        $this->report = $report;
    }
}
