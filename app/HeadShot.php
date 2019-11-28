<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadShot extends Model
{
    use SoftDeletes;

    protected $casts = [
        'current' => 'boolean',
    ];

    public function headshottable()
    {
        return $this->morphTo();
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}