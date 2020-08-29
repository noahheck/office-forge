<?php

namespace App\FileStore;

use App\User;
use App\Utility\MimeTypeIconFunctionMapper;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'filestore_media_files';

    public function downloadLink()
    {
        return route('drives.files.download', [$this->drive, $this, $this->name]);
    }

    public function icon($withClasses = [])
    {
        return MimeTypeIconFunctionMapper::iconForMimetype($this->mimetype, $withClasses);
    }

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

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
