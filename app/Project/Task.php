<?php

namespace App\Project;

use App\Project;
use App\Traits\IsEditorResource;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes,
        IsEditorResource;

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
