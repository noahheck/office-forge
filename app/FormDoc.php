<?php

namespace App;

use App\FormDoc\Field;
use App\FormDoc\Template;
use App\Traits\Authorization\GrantsAccessByTeamMembership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class FormDoc extends Model
{
    const WORK_ITEM_KEY = 'form-doc';

    use SoftDeletes,
        GrantsAccessByTeamMembership,
        HasRelationships;

    protected $dates = [
        'submitted_at',
    ];

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

    public function scopeSubmitted($query)
    {
        return $query->whereNotNull('submitted_at');
    }


    public function isSubmitted()
    {
        return !is_null($this->submitted_at);
    }
}
