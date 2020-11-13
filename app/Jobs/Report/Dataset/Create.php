<?php

namespace App\Jobs\Report\Dataset;

use App\Report;
use App\Report\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $report;
    private $name;
    private $datasetable_type;
    private $datasetable_id;

    private $dataset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Report $report, $name, $datasetable_type, $datasetable_id)
    {
        $this->report = $report;
        $this->name = $name;
        $this->datasetable_type = $datasetable_type;
        $this->datasetable_id = $datasetable_id;
    }

    public function getDataset(): Dataset
    {
        return $this->dataset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataset = new Dataset;

        $dataset->report_id = $this->report->id;
        $dataset->name = $this->name;
        $dataset->datasetable_type = $this->datasetable_type;
        $dataset->datasetable_id = $this->datasetable_id;
        $dataset->order = $this->report->datasets()->max('order') + 1;

        $dataset->save();

        $this->dataset = $dataset;
    }
}
