<?php

namespace App\FileType;

use App\FileType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panel extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_panels';

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }
}
