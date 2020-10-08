<?php

namespace App\Jobs\FormDoc;

use App\Form\DataMapper;
use App\FormDoc;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $formDoc;
    private $date;
    private $time;
    private $submitted;
    private $fieldDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FormDoc $formDoc, $date, $time, $submitted, $fieldDetails)
    {
        $this->formDoc = $formDoc;
        $this->date = $date;
        $this->time = $time;
        $this->submitted = $submitted;
        $this->fieldDetails = $fieldDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DataMapper $dataMapper)
    {
        $this->formDoc->date = $this->date;
        $this->formDoc->time = $this->time;

        if ($this->submitted) {
            $this->formDoc->submitted_at = now();
        }

        $this->formDoc->save();

        foreach ($this->formDoc->fields as $field) {
            $dataMapper->updateFieldValue($field, $field, $this->fieldDetails);

            $field->save();
        }


    }
}
