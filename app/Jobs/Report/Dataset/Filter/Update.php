<?php

namespace App\Jobs\Report\Dataset\Filter;

use App\Report\Dataset;
use App\Report\Dataset\Filter;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $filter;
    private $field_id;
    private $operator;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Filter $filter, $field_id, $operator)
    {
        $this->filter = $filter;
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
        $filter = $this->filter;

        $filter->field_id = $this->field_id;
        $filter->operator = $this->operator;

        $filter->save();
    }
}
