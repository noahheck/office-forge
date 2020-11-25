<?php

namespace App\Jobs\Report\Dataset\Field;

use App\Report\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $dataset;
    private $orderedFieldIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $orderedFieldIds)
    {
        $this->dataset = $dataset;
        $this->orderedFieldIds = $orderedFieldIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fieldOrderMap = array_flip($this->orderedFieldIds);

        $fields = $this->dataset->fields;

        foreach ($fields as $field) {

            if (!array_key_exists($field->id, $fieldOrderMap)) {

                continue;
            }

            $field->order = $fieldOrderMap[$field->id] + 1;
            $field->save();
        }

        /*$datasetOrderMap = array_flip($this->orderedDatasetIds);

        $datasets = $this->report->datasets;

        foreach ($datasets as $dataset) {

            if (!array_key_exists($dataset->id, $datasetOrderMap)) {

                continue;
            }

            $dataset->order = $datasetOrderMap[$dataset->id] + 1;
            $dataset->save();
        }*/
    }
}
