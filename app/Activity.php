<?php

namespace App;

use App\Project\Task;
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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }



}
