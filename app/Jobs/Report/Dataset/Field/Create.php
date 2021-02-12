<?php

namespace App\Jobs\Report\Dataset\Field;

use App\Report\Dataset;
use App\Report\Dataset\Field;
use App\Report\Dataset\Field\ImplicitField;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $dataset;
    private $field_id;
    private $label;

    private $field;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dataset $dataset, $field_id, $label)
    {
        $this->dataset = $dataset;
        $this->field_id = $field_id;
        $this->label = $label;
    }

    public function getField(): Field
    {
        return $this->field;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $field = new Field;
        $field->dataset_id = $this->dataset->id;

        if (is_numeric($this->field_id)) {
            $field->template_field_type = $this->dataset->datasetableTemplateFieldType();
            $field->field_type = $this->dataset->datasetableFieldType();
        } else {
            $field->template_field_type = ImplicitField::class;
            $field->field_type = ImplicitField::class;
        }

        $field->field_id = $this->field_id;
        $field->label = $this->label;
        $field->order = $this->dataset->fields()->max('order') + 1;

        $field->save();

        $this->field = $field;
    }
}
