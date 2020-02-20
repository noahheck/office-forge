<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $casts = [
        'archived' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }
}
