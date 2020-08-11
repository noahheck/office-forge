<?php

namespace App\FileType;

use App\FileType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessLock extends Model
{
    use SoftDeletes;

    protected $table = "file_type_access_locks";

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }
}
