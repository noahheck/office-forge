<?php

namespace App\Jobs\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $dataset;
    private $name;
    private $datasetable_type;
    private $datasetable_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $name, $datasetable_type, $datasetable_id)
    {
        $this->dataset = $dataset;
        $this->name = $name;
        $this->datasetable_type = $datasetable_type;
        $this->datasetable_id = $datasetable_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataset = $this->dataset;

        $dataset->name = $this->name;
        $dataset->datasetable_type = $this->datasetable_type;
        $dataset->datasetable_id = $this->datasetable_id;

        $dataset->save();
    }
}
