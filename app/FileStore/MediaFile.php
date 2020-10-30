<?php

namespace App\FileStore;

use App\FileStore\MediaFile\Version;
use App\Interfaces\Headshottable as IsHeadshottable;
use App\Traits\Headshottable;
use App\Traits\MediaFiles\MediaFileResource;
use App\User;
use App\Utility\MimeTypeIconFunctionMapper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFile extends Model implements IsHeadshottable
{
    use SoftDeletes,
        Headshottable,
        MediaFileResource;

    protected $table = 'filestore_media_files';

    public function downloadUrl()
    {
        if ($this->file_id) {

            return route('files.drives.mediaFiles.download', [$this->file_id, $this->drive, $this, $this->name]);
        }

        return route('drives.files.download', [$this->drive, $this, $this->name]);
    }

    public function previewUrl()
    {
        if ($this->file_id) {

            return route('files.drives.mediaFiles.preview', [$this->file_id, $this->drive, $this, $this->name]);
        }

        return route('drives.files.preview', [$this->drive, $this, $this->name]);
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

    public function versions()
    {
        return $this->hasMany(Version::class, 'media_file_id')->orderBy('created_at', 'DESC');
    }

    public function currentVersion()
    {
        return $this->versions->firstWhere('current_version', true);
    }
}
