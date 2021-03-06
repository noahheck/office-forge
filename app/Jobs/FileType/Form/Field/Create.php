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
    private $separator;
    private $selectOptions;
    private $decimalPlaces;
    private $userTeam;
    private $fileType;

    private $rangeMin;
    private $rangeMax;
    private $rangeMinLabel;
    private $rangeMaxLabel;

    private $field;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Form $form,
        $label,
        $description,
        $field_type,
        $selectOptions,
        $decimalPlaces,
        $userTeam,
        $fileType,
        $rangeMin,
        $rangeMax,
        $rangeMinLabel,
        $rangeMaxLabel
    ) {
        $this->form = $form;
        $this->label = $label;
        $this->description = $description;
        $this->field_type = $field_type;
        $this->selectOptions = $selectOptions;
        $this->decimalPlaces = $decimalPlaces;
        $this->userTeam = $userTeam;
        $this->fileType = $fileType;

        $this->rangeMin = $rangeMin;
        $this->rangeMax = $rangeMax;
        $this->rangeMinLabel = $rangeMinLabel;
        $this->rangeMaxLabel = $rangeMaxLabel;
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
        $options->decimal_places = $this->decimalPlaces;
        $options->user_team = $this->userTeam;
        $options->file_type = $this->fileType;
        $options->range_min = $this->rangeMin;
        $options->range_max = $this->rangeMax;
        $options->range_min_label = $this->rangeMinLabel;
        $options->range_max_label = $this->rangeMaxLabel;

        $field->options = $options;

        $field->save();

        // Add empty entry for each file this form belongs to so report queries execute correctly
        $fileType = $this->form->fileType;
        $allInstances = $fileType->files()->withTrashed()->get();
        $keyedIds = $allInstances->pluck('id')->map(function($item) {

            return ['file_id' => $item];
        });

        $field->values()->createMany($keyedIds);


        $this->field = $field;
    }
}
