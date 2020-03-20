<?php

namespace App\Jobs\FileType\Form\Field;

use App\FileType\Form\Field;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $field;
    private $label;
    private $description;
    private $field_type;
    private $active;
    private $selectOptions;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Field $field, $label, $description, $field_type, $active, $selectOptions)
    {
        $this->field = $field;
        $this->label = $label;
        $this->description = $description;
        $this->field_type = $field_type;
        $this->active = $active;
        $this->selectOptions = $selectOptions;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $field = $this->field;
        $field->field_type = $this->field_type;
        $field->label = $this->label;
        $field->description = $this->description;
        $field->active = $this->active;

        $options = new \StdClass;
        $options->select_options = $this->selectOptions;

        $field->options = $options;

        $field->save();
    }
}
