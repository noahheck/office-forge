<?php

namespace App\Process;

use App\Process;
use App\Traits\IsEditorResource;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instance extends Model
{
    use SoftDeletes,
        IsEditorResource;

    protected $table = 'process_instances';

    protected $dates = [
        'completed_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'completed' => 'boolean',
    ];

    public function getFullNameAttribute()
    {
        return $this->process_name . ' - ' . $this->name;
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function completedBy()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'process_instance_id')->orderBy('order', 'ASC');
    }
}
