<?php

namespace App\FileStore;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'filestore_media_files';

    public function getNameWithoutExtensionAttribute()
    {
        $nameParts = explode('.', $this->name);

        if (count($nameParts) === 1) {

            return $this->name;
        }

        $extension = array_pop($nameParts);

        return implode('.', $nameParts);
    }

    public function getExtensionAttribute()
    {
        $nameParts = explode('.', $this->name);

        if (count($nameParts) === 1) {

            return null;
        }

        return '.' . array_pop($nameParts);

    }

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
