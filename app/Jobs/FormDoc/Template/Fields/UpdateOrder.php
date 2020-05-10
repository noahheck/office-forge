<?php

namespace App\Jobs\FormDoc\Template\Fields;

use App\FormDoc\Template as FormDoc;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $formDoc;
    private $orderedFields;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FormDoc $formDoc, $orderedFields)
    {
        $this->formDoc = $formDoc;
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

        $fields = $this->formDoc->fields;

        foreach ($fields as $field) {

            if (!array_key_exists($field->id, $fieldOrderMap)) {

                continue;
            }

            $field->order = $fieldOrderMap[$field->id] + 1;
            $field->save();
        }
    }
}
