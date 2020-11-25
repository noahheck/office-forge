<?php

namespace App\FormDoc;

use App\FileType;
use App\FormDoc;
use App\FormDoc\Template\Field;
use App\Interfaces\Datasetable;
use App\Process;
use App\Report\Dataset\Filter;
use App\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model implements Datasetable
{
    const DATASET_FILTER_DATE = 'date';
    const DATASET_FILTER_CREATED_DATE = 'created_date';
    const DATASET_FILTER_CREATED_BY = 'created_by';

    use SoftDeletes;

    protected $table = 'form_doc_templates';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function icon(array $withClasses = [])
    {
        return \App\icon\formDocs($withClasses);
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class, 'form_doc_templates_processes', 'form_doc_template_id', 'process_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'form_doc_templates_teams', 'form_doc_template_id', 'team_id')->withTimestamps();
    }

    public function creatingTeams()
    {
        return $this->teams()->wherePivot('create', 1);
    }

    public function reviewingTeams()
    {
        return $this->teams()->wherePivot('review', 1);
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'form_doc_template_id')->orderBy('order');
    }

    public function activeFields()
    {
        return $this->fields()->where('active', true)->orderBy('order');
    }

    public function instances()
    {
        return $this->hasMany(FormDoc::class, 'form_doc_template_id');
    }

    public function filterableFieldOptions()
    {
        $implicitFieldOptions = [
            Filter::makeFilterOption(self::DATASET_FILTER_DATE, __('formDoc.date'), Filter::FILTER_OPTION_TYPE_DATE, []),
            Filter::makeFilterOption(self::DATASET_FILTER_CREATED_DATE, __('formDoc.createdDate'), Filter::FILTER_OPTION_TYPE_DATE, []),
            Filter::makeFilterOption(self::DATASET_FILTER_CREATED_BY, __('formDoc.createdBy'), Filter::FILTER_OPTION_TYPE_USER, []),
        ];

        $templateFields = [];

        foreach ($this->activeFields as $field) {

            if (!Filter::isValidFilterFieldType($field->field_type)) {
                continue;
            }

            $templateFields[] = Filter::makeFilterOption($field->id, $field->label, $field->field_type, $field->options);
        }

        $response = [
            "" => $implicitFieldOptions,
            __("formDoc.formName_fields", ['formName' => $this->name]) => $templateFields,
        ];

        return $response;
    }

    public function reportableFieldOptions()
    {
        $filterableFields = $this->filterableFieldOptions();

        unset($filterableFields[""]);

        return $filterableFields;
    }



    public static function getTeamSyncStructure($creatingTeams, $reviewingTeams)
    {
        $response = [];

        foreach ($creatingTeams as $team) {
            $response[$team]['create'] = 1;
            $response[$team]['review'] = 0;
        }

        foreach ($reviewingTeams as $team) {
            $response[$team]['create'] = $response[$team]['create'] ?? 0;
            $response[$team]['review'] = 1;
        }

        return $response;
    }
}
