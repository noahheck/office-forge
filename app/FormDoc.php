<?php

namespace App;

use App\FormDoc\Field;
use App\FormDoc\Template;
use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class FormDoc extends Model
{
    const WORK_ITEM_KEY = 'form-doc';

    use SoftDeletes,
        HasRelationships;

    protected $dates = [
        'submitted_at',
    ];

    public function getDateAttribute($value)
    {
        return ($value) ? \App\format_date_string($value) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function getTimeAttribute($value)
    {
        return \App\format_timeString($value);
    }

    public function setTimeAttribute($value)
    {
        $this->attributes['time'] = \App\format_timeStringForDatabase($value);
    }



    public function workItemListHref()
    {
        if ($this->submitted_at) {

            return route("form-docs.show", [$this]);
        }

        return route('form-docs.edit', [$this]);
    }

    public function icon($withClasses = [])
    {
        return \App\icon\formDocs($withClasses);
    }

    public function scopeSubmittedSince($query, $since = '')
    {
        if (!$since) {
            return $query;
        }

        return $query->where('submitted_at', ">=", $since);
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'form_doc_template_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'form_doc_id');
    }

    public function teams()
    {
        return $this->hasManyDeep(
            Team::class,
            [Template::class, 'form_doc_templates_teams',],
            ['id',                   'form_doc_template_id', 'id'],
            ['form_doc_template_id', 'id',                   'team_id',]
        );
    }

    public function datasets()
    {
        return $this->morphMany(Dataset::class, 'datasetable');
    }

    public function scopeSubmitted($query)
    {
        return $query->whereNotNull('submitted_at');
    }


    public function isSubmitted()
    {
        return !is_null($this->submitted_at);
    }
}
