<?php

namespace App\Jobs\Report\Dataset\Filter;

use App\Report\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $dataset;
    private $orderedFilterIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $orderedFilterIds)
    {
        $this->dataset = $dataset;
        $this->orderedFilterIds = $orderedFilterIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filterOrderMap = array_flip($this->orderedFilterIds);

        $filters = $this->dataset->filters;

        foreach ($filters as $filter) {

            if (!array_key_exists($filter->id, $filterOrderMap)) {

                continue;
            }

            $filter->order = $filterOrderMap[$filter->id] + 1;
            $filter->save();
        }
    }
}
