<?php

namespace App\FileType;

use App\FileType;
use App\FileType\Form\Field;
use App\Team;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panel extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_panels';

    // Same function as in Forms - extract to trait when appropriate
    public function isAccessibleBy(User $user): bool
    {
        $formTeams = $this->teams;
        $userTeams = $user->teams;

        $sharedTeams = $formTeams->intersect($userTeams);

        return $sharedTeams->count() > 0;
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'file_type_panels_teams', 'file_type_panel_id', 'team_id')->withTimestamps();
    }

    public function fields()
    {
        return $this->belongsToMany(
                Field::class,
                'file_type_panels_fields',
                'file_type_panel_id',
                'file_type_form_field_id'
            )->withPivot('order')
            ->orderBy('file_type_panels_fields.order')
            ->withTimestamps();
    }
}
