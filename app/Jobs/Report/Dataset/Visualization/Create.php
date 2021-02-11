<?php

namespace App\Jobs\Report\Dataset\Visualization;

use App\Report\Dataset;
use App\Report\Dataset\Visualization;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable;

    private $dataset;
    private $label;
    private $type;
    private $field_id;

    private $visualization;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $label, $type, $field_id)
    {
        $this->dataset = $dataset;
        $this->label = $label;
        $this->type = $type;
        $this->field_id = $field_id;
    }

    public function getVisualization(): Visualization
    {
        return $this->visualization;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $visualization = new Visualization;
        $visualization->dataset_id = $this->dataset->id;
        $visualization->label = $this->label;
        $visualization->type = $this->type;
        $visualization->field_id = $this->field_id;

        $visualization->order = $this->dataset->visualizations()->max('order') + 1;

        $visualization->save();

        $this->visualization = $visualization;
    }
}
