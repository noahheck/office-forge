<?php

namespace App\Jobs\FormDoc;

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
    private $creator;
    private $submitted;
    private $fieldDetails;

    private $formDoc;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Template $template, ?File $file, User $creator, $submitted, $fieldDetails)
    {
        $this->template = $template;
        $this->file = $file;
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

        $formDoc->save();

        $this->formDoc = $formDoc;

        $formDocId = $formDoc->id;

        foreach ($this->template->fields as $templateField) {

            $field = new Field;
            $field->form_doc_id = $formDocId;
            $field->form_doc_template_field_id = $templateField->id;
            $field->field_type = $templateField->field_type;
            $field->label = $templateField->label;
            $field->description = $templateField->description;
            $field->separator = $templateField->separator;
            $field->order = $templateField->order;
            $field->options = $templateField->options;

            $dataMapper->updateFieldValue($templateField, $field, $this->fieldDetails);

            $field->save();
        }
    }
}
