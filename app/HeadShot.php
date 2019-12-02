<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadShot extends Model
{
    const MAX_BASE_WIDTH = 500;
    const MAX_BASE_HEIGHT = 500;
    const MAX_THUMB_WIDTH = 200;
    const MAX_THUMB_HEIGHT = 200;
    const MAX_ICON_WIDTH = 50;
    const MAX_ICON_HEIGHT = 50;

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
