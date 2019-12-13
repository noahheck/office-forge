<?php

namespace App\Project;

use App\Project;
use App\Interfaces\HasDueDate as HasDueDateInterface;
use App\Traits\HasDueDate;
use App\Traits\IsEditorResource;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model implements HasDueDateInterface
{
    use SoftDeletes,
        IsEditorResource,
        HasDueDate;

    protected $dates = [
        'due_date',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
