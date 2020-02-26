<?php

namespace App\FileType;

use App\FileType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_forms';

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }
}
