<?php

namespace App\Jobs\Report\Dataset\Filter;

use App\Report\Dataset;
use App\Report\Dataset\Filter;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $dataset;
    private $field_id;
    private $operator;

    private $filter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $field_id, $operator)
    {
        $this->dataset = $dataset;
        $this->field_id = $field_id;
        $this->operator = $operator;
    }

    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filter = new Filter;

        $filter->dataset_id = $this->dataset->id;
        $filter->field_id = $this->field_id;
        $filter->operator = $this->operator;

        $filter->save();

        $this->filter = $filter;
    }
}
