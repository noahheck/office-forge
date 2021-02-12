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
