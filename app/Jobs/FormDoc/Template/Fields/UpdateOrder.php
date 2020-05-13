<?php

namespace App\Jobs\FormDoc\Template\Fields;

use App\FormDoc\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $template;
    private $orderedFields;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Template $template, $orderedFields)
    {
        $this->template = $template;
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

        $fields = $this->template->fields;

        foreach ($fields as $field) {

            if (!array_key_exists($field->id, $fieldOrderMap)) {

                continue;
            }

            $field->order = $fieldOrderMap[$field->id] + 1;
            $field->save();
        }
    }
}
