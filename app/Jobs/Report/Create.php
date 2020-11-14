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
    private $filter_user;
    private $filter_date;
    private $active;
    private $teams;

    private $report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $description, $filter_user, $filter_date, $active, $teams)
    {
        $this->name = $name;
        $this->description = $description;
        $this->filter_user = $filter_user;
        $this->filter_date = $filter_date;
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
        $report->filter_user = $this->filter_user;
        $report->filter_date = $this->filter_date;
        $report->active = $this->active;

        $report->save();

        $report->teams()->sync($this->teams);

        $this->report = $report;
    }
}
