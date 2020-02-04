<?php

namespace App\Process\Instance\Task;

use App\Process\Instance\Task;
use App\Process\Task\Action as ActionTemplate;
use App\Traits\IsEditorResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use SoftDeletes,
        IsEditorResource;

    protected $table = 'process_instance_task_actions';

    protected $dates = [
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function taskInstance()
    {
        return $this->belongsTo(Task::class, 'process_instance_task_id');
    }

    public function template()
    {
        return $this->belongsTo(ActionTemplate::class, 'process_task_action_id');
    }
}
