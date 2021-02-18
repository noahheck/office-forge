<?php

namespace App\Report;

use App\FileType;
use App\FormDoc\Template;
use App\Report;
use App\Report\Dataset\Field;
use App\Report\Dataset\Filter;
use App\Report\Dataset\Visualization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\FormDoc\Field as FormDocField;
use App\FormDoc\Template\Field as FormDocTemplateField;
use App\FileType\Form\Field as FileTypeFormField;

class Dataset extends Model
{
    use SoftDeletes;

    protected $table = 'report_datasets';

    protected $casts = [
        'order' => 'integer',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function datasetable()
    {
        return $this->morphTo();
    }

    public function filters()
    {
        return $this->hasMany(Filter::class, 'dataset_id')->ordered();
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'dataset_id')->orderBy('order');
    }

    public function visualizations()
    {
        return $this->hasMany(Visualization::class, 'dataset_id')->ordered();
    }

    public function sumOrAverageableFieldOptions()
    {
        $sumOrAverageableFieldTypes = collect([
            Field::FIELD_OPTION_TYPE_RANGE,
            Field::FIELD_OPTION_TYPE_INTEGER,
            Field::FIELD_OPTION_TYPE_DECIMAL,
            Field::FIELD_OPTION_TYPE_MONEY,
            Field::FIELD_OPTION_TYPE_CHECKBOX,
        ]);

        return $this->fields->filter(function($field) use ($sumOrAverageableFieldTypes) {

            if ($field->isImplicitField()) {

                return false;
            }

            return $sumOrAverageableFieldTypes->contains($field->templateField->field_type);
        });
    }

    public function aggregateFieldOptions()
    {
        $aggregateFieldTypes = collect([
            Field::FIELD_OPTION_TYPE_DATE,
            Field::FIELD_OPTION_TYPE_CHECKBOX,
            Field::FIELD_OPTION_TYPE_SELECT,
            Field::FIELD_OPTION_TYPE_USER,
            Field::FIELD_OPTION_TYPE_FILE,
        ]);

        return $this->fields->filter(function($field) use ($aggregateFieldTypes) {

            if ($field->isImplicitField()) {

                return true;
            }

            return $aggregateFieldTypes->contains($field->templateField->field_type);
        });
    }

    public function rangeFieldAverageOptions()
    {
        $rangeFieldTypes = collect([
            Field::FIELD_OPTION_TYPE_RANGE,
        ]);

        return $this->fields->filter(function($field) use ($rangeFieldTypes) {

            if ($field->isImplicitField()) {

                return false;
            }

            return $rangeFieldTypes->contains($field->templateField->field_type);
        });
    }

    public function isFileType(): bool
    {
        return $this->datasetable_type === FileType::class;
    }

    public function isFormDocTemplate()
    {
        return $this->datasetable_type === Template::class;
    }

    public function datasetableFieldType()
    {
        $fieldType = '';

        switch ($this->datasetable_type):

            case FileType::class:
                $fieldType = FileTypeFormField::class;
                break;

            case Template::class:
                $fieldType = FormDocField::class;
                break;

        endswitch;

        return $fieldType;
    }

    public function datasetableTemplateFieldType()
    {
        $fieldType = '';

        switch ($this->datasetable_type):

            case FileType::class:
                $fieldType = FileTypeFormField::class;
                break;

            case Template::class:
                $fieldType = FormDocTemplateField::class;
                break;

        endswitch;

        return $fieldType;
    }


    public function instanceAttributeFilters()
    {
        return $this->filters->filter(function($filter) {
            return !is_numeric($filter->field_id);
        });
    }

    public function instanceFormFilters()
    {
        return $this->filters->filter(function($filter) {
            return is_numeric($filter->field_id);
        });
    }



}
