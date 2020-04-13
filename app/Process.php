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

    public function creatingTeams()
    {
        return $this->belongsToMany(Team::class, 'processes_teams_creators');
    }

    public function creatingMembers()
    {
        $this->load(['creatingTeams', 'creatingTeams.members']);

        return $this->creatingTeams->map(function($team, $i) {
            return $team->members;
        })->flatten()->unique('id')->sortBy('name');
    }

    public function canBeCreatedBy(User $user)
    {
        return $this->creatingMembers()->pluck('id')->contains($user->id);
    }




    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('order', 'ASC');
    }

    public function activeTasks()
    {
        return $this->tasks()->where('active', true);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
