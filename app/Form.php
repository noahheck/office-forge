<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }
}
