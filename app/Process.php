<?php

namespace App;

use App\Process\Instance;
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

    public function instantiatingMembers()
    {
        $this->load(['instantiatingTeams', 'instantiatingTeams.members']);

        return $this->instantiatingTeams->map(function($team, $i) {
            return $team->members;
        })->flatten()->unique('id')->sortBy('name');
    }

    public function canBeInstantiatedBy(User $user)
    {
        return $this->instantiatingMembers()->pluck('id')->contains($user->id);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('order', 'ASC');
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }
}
