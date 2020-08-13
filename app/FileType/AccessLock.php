<?php

namespace App\FileType;

use App\File;
use App\FileType;
use App\User;
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

    public function files()
    {
        return $this->belongsToMany(File::class, 'file_access_locks')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_access_keys')->withTimestamps();
    }
}
