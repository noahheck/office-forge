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
    const WORK_ITEM_KEY = 'activity';

    use SoftDeletes,
        IsEditorResource,
        HasDueDate;

    protected $dates = [
        'due_date',
        'completed_at',
    ];

    protected $casts = [
        'private' => 'boolean',
        'active' => 'boolean',
        'completed' => 'boolean',
    ];

    public function workItemListHref()
    {
        return route('activities.show', [$this]);
    }

    public function getFullName()
    {
        $name = $this->process_name;
        $name .= ($name && $this->name) ? ' - ' : '';
        $name .= $this->name;

        return $name;
    }

    public function icon($withClasses = [])
    {
        return \App\icon\forActivity($this, $withClasses);
    }

    public function isAccessibleBy(User $user)
    {
        // System administrators can view all Activities
        if ($user->isAdministrator()) {

            return true;
        }

        // Owner's can always access the Activity
        if ($this->owner_id === $user->id) {

            return true;
        }

        // Participant's on an Activity can view it
        if ($this->participants->pluck('user_id')->contains($user->id)) {

            return true;
        }

        // If it's a process activity, check the user is able to access that process
        if ($this->process_id) {

            return $this->process->isAccessibleBy($user);
        }

        // Public activities can be viewed by anyone
        if (!$this->private) {

            return true;
        }

        // All checks have been done - the user cannot access this Activity
        return false;
    }

    public function canBeEditedBy(User $user)
    {
        return $user->isAdministrator()
        || $this->owner_id == $user->id;
    }

    public function canHaveTasksEditedBy(User $user)
    {
        if ($this->canBeEditedBy($user)) {

            return true;
        }

        return $this->participants()->pluck('user_id')->contains($user->id);
    }



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

    public function participantUsers()
    {
        return $this->participants->pluck('user');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function openTasks()
    {
        return $this->tasks()->where('completed', false)->orderBy('order');
    }

    public function completedTasks()
    {
        return $this->tasks()->where('completed', true)->orderBy('completed_at');
    }

    public function formDocs()
    {
        return $this->hasMany(FormDoc::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function resourceFiles()
    {
        return $this->morphMany(ResourceFile::class, 'resource');
    }



    public function earliestOpenTaskWithDueDate()
    {
        return $this->tasks->where('completed', false)->whereNotNull('due_date')->sortBy('due_date')->first();
    }

    public function numberOfTotalTasks()
    {
        return count($this->tasks);
    }

    public function numberOfCompletedTasks()
    {
        return count($this->tasks->where('completed', true));
    }


    public function numberOfTotalFormDocs()
    {
        return count($this->formDocs);
    }

    public function numberOfCompletedFormDocs()
    {
        return count($this->formDocs->whereNotNull('submitted_at'));
    }

}
