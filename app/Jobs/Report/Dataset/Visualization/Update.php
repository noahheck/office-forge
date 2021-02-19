<?php

namespace App\Jobs\Report\Dataset\Visualization;

use App\Report\Dataset\Visualization;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable;

    private $visualization;
    private $label;
    private $type;
    private $field_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Visualization $visualization, $label, $type, $field_id)
    {
        $this->visualization = $visualization;
        $this->label = $label;
        $this->type = $type;
        $this->field_id = $field_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $options = new \stdClass;

        $visualization = $this->visualization;
        $visualization->label = $this->label;
        $visualization->type = $this->type;

        $visualization->field_id = null;

        if (is_array($this->field_id)) {
            $options->multiple_field_ids = $this->field_id;
        } else {
            $visualization->field_id = $this->field_id;
        }

        $visualization->options = $options;

        $visualization->save();
    }
}
