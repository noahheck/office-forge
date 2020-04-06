<?php

namespace App\Process;

use App\Process;
use App\Traits\IsEditorResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes,
        IsEditorResource;

    protected $table = 'process_tasks';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
