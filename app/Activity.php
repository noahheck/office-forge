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
    const WORK_ITEM_EDIT_ROUTE = 'activities.edit';

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

    public function getFullName()
    {
        $name = $this->process_name;
        $name .= ($name && $this->name) ? ' - ' : '';
        $name .= $this->name;

        return $name;
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
