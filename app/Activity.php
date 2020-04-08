<?php

namespace App;

use App\Activity\Participant;
use App\Activity\Task;
use App\Traits\HasDueDate;
use App\Traits\IsEditorResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes,
        IsEditorResource,
        HasDueDate;

    protected $dates = [
        'due_date',
    ];

    protected $casts = [
        'active' => 'boolean',
        'completed' => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class)->where('removed_at', null);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function numberOfTotalTasks()
    {
        return count($this->tasks);
    }

    public function numberOfCompletedTasks()
    {
        return count($this->tasks->where('completed', true));
    }

}
