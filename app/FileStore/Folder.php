<?php

namespace App\FileStore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $table = 'filestore_folders';

    public function drive()
    {
        return $this->belongsTo(Drive::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public function folders()
    {
        return $this->hasMany(self::class, 'parent_folder_id');
    }

    public function parentFolder()
    {
        return $this->belongsTo(self::class, 'parent_folder_id');
    }
}
