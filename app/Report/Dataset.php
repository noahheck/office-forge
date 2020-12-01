<?php

namespace App\Report;

use App\FileType;
use App\FormDoc\Template;
use App\Report;
use App\Report\Dataset\Field;
use App\Report\Dataset\Filter;
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
        return $this->hasMany(Filter::class, 'dataset_id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'dataset_id')->orderBy('order');
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
