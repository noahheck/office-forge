<?php

namespace App\Jobs\File\Form;

use App\File;
use App\File\FormField\DataMapper;
use App\File\FormField\Value;
use App\FileType\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $file;
    private $form;
    private $fieldDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $file, Form $form, $fieldDetails)
    {
        $this->file = $file;
        $this->form = $form;
        $this->fieldDetails = $fieldDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DataMapper $dataMapper)
    {
        $values = $this->file->formFieldValues;

        foreach ($this->form->activeFields as $field) {
            $value = $values->firstWhere('file_type_form_field_id', $field->id);

            if (!$value) {
                $value                          = new Value();
                $value->file_id                 = $this->file->id;
                $value->file_type_form_field_id = $field->id;
            }

            $dataMapper->updateFieldValue($field, $value, $this->fieldDetails);

            $value->save();
        }

    }
}
