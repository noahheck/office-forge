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
}
