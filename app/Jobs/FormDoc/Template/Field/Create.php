<?php

namespace App\Jobs\FormDoc\Template\Field;

use App\FormDoc\Template;
use App\FormDoc\Template\Field;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $template;
    private $label;
    private $description;
    private $field_type;
    private $separator;
    private $selectOptions;
    private $decimalPlaces;
    private $userTeam;
    private $fileType;

    private $field;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Template $template,
        $label,
        $description,
        $field_type,
        $separator,
        $selectOptions,
        $decimalPlaces,
        $userTeam,
        $fileType
    ) {
        $this->template = $template;
        $this->label = $label;
        $this->description = $description;
        $this->field_type = $field_type;
        $this->separator = $separator;
        $this->selectOptions = $selectOptions;
        $this->decimalPlaces = $decimalPlaces;
        $this->userTeam = $userTeam;
        $this->fileType = $fileType;
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
        $field->form_doc_template_id = $this->template->id;
        $field->field_type = $this->field_type;
        $field->label = $this->label;
        $field->description = $this->description;
        $field->separator = $this->separator;
        $field->active = true;
        $field->order = $this->template->fields->max('order') + 1;

        $options = new \StdClass;
        $options->select_options = $this->selectOptions;
        $options->decimal_places = $this->decimalPlaces;
        $options->user_team = $this->userTeam;
        $options->file_type = $this->fileType;

        $field->options = $options;

        $field->save();

        $this->field = $field;
    }
}
