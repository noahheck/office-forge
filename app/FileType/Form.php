<?php

namespace App\FileType;

use App\FileType;
use App\FileType\Form\Field;
use App\Team;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_forms';

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    public function isAccessibleBy(User $user): bool
    {
        $formTeams = $this->teams;
        $userTeams = $user->teams;

        $sharedTeams = $formTeams->intersect($userTeams);

        \Debugbar::info($sharedTeams);

        return $sharedTeams->count() > 0;
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'file_type_form_id')->orderBy('order', 'ASC');
    }

    public function activeFields()
    {
        return $this->hasMany(Field::class, 'file_type_form_id')->where('active', true)->orderBy('order', 'ASC');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'file_type_forms_teams', 'file_type_form_id', 'team_id')->withTimestamps();
    }
}
