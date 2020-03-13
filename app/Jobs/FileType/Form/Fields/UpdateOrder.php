<?php

namespace App\Jobs\FileType\Form\Fields;

use App\FileType;
use App\FileType\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $fileType;
    private $form;
    private $orderedFields;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, Form $form, $orderedFields)
    {
        $this->fileType = $fileType;
        $this->form = $form;
        $this->orderedFields = $orderedFields;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fieldOrderMap = array_flip($this->orderedFields);

        $fields = $this->form->fields;

        foreach ($fields as $field) {

            if (!array_key_exists($field->id, $fieldOrderMap)) {

                continue;
            }

            $field->order = $fieldOrderMap[$field->id] + 1;
            $field->save();
        }
    }
}
