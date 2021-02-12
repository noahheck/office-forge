<?php

namespace App\Jobs\Report\Dataset\Field;

use App\Report\Dataset;
use App\Report\Dataset\Field;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $field;
    private $field_id;
    private $label;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Field $field, $field_id, $label)
    {
        $this->field = $field;
        $this->field_id = $field_id;
        $this->label = $label;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $field = $this->field;
        $field->field_id = $this->field_id;
        $field->label = $this->label;

        $field->save();
    }
}
