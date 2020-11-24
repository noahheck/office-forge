<?php

namespace App\Jobs\Report\Dataset;

use App\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $report;
    private $orderedDatasetIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Report $report, $orderedDatasetIds)
    {
        $this->report = $report;
        $this->orderedDatasetIds = $orderedDatasetIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $datasetOrderMap = array_flip($this->orderedDatasetIds);

        $datasets = $this->report->datasets;

        foreach ($datasets as $dataset) {

            if (!array_key_exists($dataset->id, $datasetOrderMap)) {

                continue;
            }

            $dataset->order = $datasetOrderMap[$dataset->id] + 1;
            $dataset->save();
        }
    }
}
