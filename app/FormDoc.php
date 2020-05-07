<?php

namespace App;

use App\FormDoc\Field;
use App\Traits\Authorization\GrantsAccessByTeamMembership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormDoc extends Model
{
    use SoftDeletes,
        GrantsAccessByTeamMembership;

    protected $table = 'form_docs';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'form_docs_teams')->withTimestamps();
    }

    public function fields()
    {
        return $this->hasMany(Field::class)->orderBy('order');
    }
}
