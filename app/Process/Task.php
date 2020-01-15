<?php

namespace App\Process;

use App\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $table = 'process_tasks';

    use SoftDeletes;

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
