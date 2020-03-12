<?php

namespace App;

use App\Traits\GetsInitialsFromName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes,
        GetsInitialsFromName;


    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function icon()
    {
        return "<span class='team-icon' style='background-color: {$this->color};' title='" . e($this->name) . "'>{$this->initials}</span>";
    }


    public function instantiableProcesses()
    {
        return $this->belongsToMany(Process::class, 'processes_teams_instantiators');
    }

    public function fileTypeForms()
    {
        return $this->belongsToMany(Team::class, 'file_type_forms_teams', 'team_id' , 'file_type_form_id')->withTimestamps();
    }
}
