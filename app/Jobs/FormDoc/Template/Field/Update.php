<?php

namespace App\Jobs\FormDoc\Template\Field;

use App\FormDoc\Template\Field;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $field;
    private $label;
    private $description;
    private $field_type;
    private $active;
    private $selectOptions;
    private $decimalPlaces;
    private $userTeam;
    private $fileType;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Field $field,
        $label,
        $description,
        $field_type,
        $active,
        $selectOptions,
        $decimalPlaces,
        $userTeam,
        $fileType
    ) {
        $this->field = $field;
        $this->label = $label;
        $this->description = $description;
        $this->field_type = $field_type;
        $this->active = $active;
        $this->selectOptions = $selectOptions;
        $this->decimalPlaces = $decimalPlaces;
        $this->userTeam = $userTeam;
        $this->fileType = $fileType;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $field = $this->field;
        $field->field_type = $this->field_type;
        $field->label = $this->label;
        $field->description = $this->description;
        $field->active = $this->active;

        $options = new \StdClass;
        $options->select_options = $this->selectOptions;
        $options->decimal_places = $this->decimalPlaces;
        $options->user_team = $this->userTeam;
        $options->file_type = $this->fileType;

        $field->options = $options;

        $field->save();
    }
}
