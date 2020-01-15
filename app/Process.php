<?php

namespace App;

use App\Process\Task;
use App\Traits\IsEditorResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes,
        IsEditorResource;

    protected $casts = [
        'active' => 'boolean',
    ];

    public function instantiatingTeams()
    {
        return $this->belongsToMany(Team::class, 'processes_teams_instantiators');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
