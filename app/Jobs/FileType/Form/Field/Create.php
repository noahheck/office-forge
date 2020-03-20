<?php

namespace App\Jobs\FileType\Form\Field;

use App\FileType\Form;
use App\FileType\Form\Field;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $form;
    private $label;
    private $description;
    private $field_type;
    private $selectOptions;

    private $field;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Form $form, $label, $description, $field_type, $selectOptions)
    {
        $this->form = $form;
        $this->label = $label;
        $this->description = $description;
        $this->field_type = $field_type;
        $this->selectOptions = $selectOptions;
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
        $field->file_type_form_id = $this->form->id;
        $field->field_type = $this->field_type;
        $field->label = $this->label;
        $field->description = $this->description;
        $field->active = true;
        $field->order = $this->form->fields->max('order') + 1;

        $options = new \StdClass;
        $options->select_options = $this->selectOptions;

        $field->options = $options;

        $field->save();

        $this->field = $field;
    }
}
