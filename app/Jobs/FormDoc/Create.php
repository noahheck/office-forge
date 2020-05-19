<?php

namespace App\Jobs\FormDoc;

use App\Activity;
use App\File;
use App\Form\DataMapper;
use App\FormDoc;
use App\FormDoc\Field;
use App\FormDoc\Template;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $template;
    private $file;
    private $activity;
    private $creator;
    private $submitted;
    private $fieldDetails;

    private $formDoc;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Template $template,
        ?File $file,
        ?Activity $activity,
        User $creator,
        $submitted,
        $fieldDetails
    ) {
        $this->template = $template;
        $this->file = $file;
        $this->activity = $activity;
        $this->creator = $creator;
        $this->submitted = $submitted;
        $this->fieldDetails = $fieldDetails;
    }

    public function getFormDoc(): FormDoc
    {
        return $this->formDoc;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DataMapper $dataMapper)
    {
        $formDoc = new FormDoc;
        $formDoc->form_doc_template_id = $this->template->id;
        $formDoc->file_id = ($this->file) ? $this->file->id : null;
        $formDoc->name = $this->template->name;
        $formDoc->creator_id = $this->creator->id;

        $formDoc->submitted_at = ($this->submitted) ? now() : null;

        if ($this->activity) {
            $formDoc->activity_id = $this->activity->id;
        }

        $formDoc->save();

        $this->formDoc = $formDoc;

        $formDocId = $formDoc->id;

        foreach ($this->template->activeFields as $templateField) {

            $field = new Field;
            $field->form_doc_id = $formDocId;
            $field->form_doc_template_field_id = $templateField->id;
            $field->field_type = $templateField->field_type;
            $field->label = $templateField->label;
            $field->description = $templateField->description;
            $field->order = $templateField->order;
            $field->options = $templateField->options;

            $dataMapper->updateFieldValue($templateField, $field, $this->fieldDetails);

            $field->save();
        }

        $this->template->last_created_at = now();
        $this->template->save();
    }
}
