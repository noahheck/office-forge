<?php

namespace App\Process\Instance;

use App\Process\Instance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

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
}
