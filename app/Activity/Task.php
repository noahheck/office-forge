<?php

namespace App\Activity;

use App\Activity;
use App\Interfaces\HasDueDate as HasDueDateInterface;
use App\Traits\HasDueDate;
use App\Traits\IsEditorResource;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model implements HasDueDateInterface
{
    const WORK_ITEM_KEY = 'task';

    use SoftDeletes,
        IsEditorResource,
        HasDueDate;

    protected $table = 'activity_tasks';

    protected $dates = [
        'due_date',
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function workItemListHref()
    {
        return route('activities.tasks.show', [$this->activity_id, $this]);
    }

    public function scopeOpen($query)
    {
        return $query->where('completed', false);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function completedBy()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}
