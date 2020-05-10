<?php

namespace App\FormDoc;

use App\FileType;
use App\FormDoc\Template\Field;
use App\Team;
use App\Traits\Authorization\GrantsAccessByTeamMembership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes,
        GrantsAccessByTeamMembership;

    protected $table = 'form_doc_templates';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'form_doc_templates_teams', 'form_doc_template_id', 'team_id')->withTimestamps();
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'form_doc_template_id')->orderBy('order');
    }
}
