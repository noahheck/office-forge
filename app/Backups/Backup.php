<?php

namespace App\Backups;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Backup extends Model
{
    use SoftDeletes;

    protected $dates = [
        'started',
        'completed',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('started', 'DESC');
    }
}
