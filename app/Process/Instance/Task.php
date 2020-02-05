<?php

namespace App\Process\Instance;

use App\Process\Instance;
use App\Process\Instance\Task\Action;
use App\Process\Task as TaskTemplate;
use App\Traits\IsEditorResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes,
        IsEditorResource;

    protected $table = 'process_instance_tasks';

    protected $dates = [
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function processInstance()
    {
        return $this->belongsTo(Instance::class, 'process_instance_id');
    }

    public function template()
    {
        return $this->belongsTo(TaskTemplate::class, 'task_id');
    }

    public function actions()
    {
        return $this->hasMany(Action::class, 'process_instance_task_id');
    }

    public function numberOfTotalActions()
    {
        return count($this->actions);
    }

    public function numberOfCompletedActions()
    {
        return count($this->actions->where('completed', true));
    }
}
