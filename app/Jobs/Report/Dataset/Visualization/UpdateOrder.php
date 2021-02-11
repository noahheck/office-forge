<?php

namespace App\Jobs\Report\Dataset\Visualization;

use App\Report\Dataset;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable;

    private $dataset;
    private $orderedVisualizationIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $orderedVisualizationIds)
    {
        $this->dataset = $dataset;
        $this->orderedVisualizationIds = $orderedVisualizationIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$filterOrderMap = array_flip($this->orderedFilterIds);
        //
        //        $filters = $this->dataset->filters;
        //
        //        foreach ($filters as $filter) {
        //
        //            if (!array_key_exists($filter->id, $filterOrderMap)) {
        //
        //                continue;
        //            }
        //
        //            $filter->order = $filterOrderMap[$filter->id] + 1;
        //            $filter->save();
        //        }

        $visualizationOrderMap = array_flip($this->orderedVisualizationIds);

        $visualizations = $this->dataset->visualizations;

        foreach ($visualizations as $visualization) {

            if (!array_key_exists($visualization->id, $visualizationOrderMap)) {

                continue;
            }

            $visualization->order = $visualizationOrderMap[$visualization->id] + 1;
            $visualization->save();
        }
    }
}
