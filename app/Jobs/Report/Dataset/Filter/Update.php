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
    private $value1;
    private $value2;
    private $value3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Filter $filter, $field_id, $operator, $value1, $value2, $value3)
    {
        $this->filter = $filter;
        $this->field_id = $field_id;
        $this->operator = $operator;
        $this->value1 = $value1;
        $this->value2 = $value2;
        $this->value3 = $value3;
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
        $filter->value_1 = $this->value1;
        $filter->value_2 = $this->value2;
        $filter->value_3 = $this->value3;

        $filter->save();
    }
}
