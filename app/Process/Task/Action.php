<?php

namespace App\Process\Task;

use App\Process\Task;
use App\Traits\IsEditorResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use SoftDeletes,
        IsEditorResource;

    protected $table = 'process_task_actions';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
