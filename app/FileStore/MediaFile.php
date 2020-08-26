<?php

namespace App\FileStore;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'filestore_media_files';

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public function drive()
    {
        return $this->belongsTo(Drive::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
