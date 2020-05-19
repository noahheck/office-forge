<?php

namespace App;

use App\FormDoc\Template;
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

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function creatingTeams()
    {
        return $this->belongsToMany(Team::class, 'processes_teams_creators');
    }

    public function canBeCreatedBy(User $user)
    {
        $teams = $this->creatingTeams;

        if ($teams->count() < 1) {

            return true;
        }

        $userTeams = $user->teams;

        $sharedTeams = $teams->intersect($userTeams);

        return $sharedTeams->count() > 0;
    }

    public function isAccessibleBy(User $user)
    {
        return $this->canBeCreatedBy($user);
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

    public function templates()
    {
        return $this->belongsToMany(Template::class, 'form_doc_templates_processes', 'process_id', 'form_doc_template_id');
    }

    public function activeTemplates()
    {
        return $this->templates()->where('active', true);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
