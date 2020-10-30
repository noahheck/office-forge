<?php

namespace App\FileStore\MediaFile;

use App\Interfaces\Headshottable as IsHeadshottable;
use App\FileStore\MediaFile;
use App\Traits\Headshottable;
use App\Traits\MediaFiles\MediaFileResource;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Version extends Model implements IsHeadshottable
{
    use Headshottable,
        MediaFileResource;

    protected $table = 'filestore_media_file_versions';

    protected $casts = [
        'current_version' => 'boolean',
    ];

    public function downloadUrl()
    {
        if ($this->file_id) {

            return route('files.drives.mediaFiles.download-version', [$this->mediaFile->file_id, $this->mediaFile->drive, $this->mediaFile, $this, $this->name]);
        }

        return route('drives.files.download-version', [$this->mediaFile->drive, $this->mediaFile, $this, $this->name]);
    }

    public function previewUrl()
    {
        if ($this->file_id) {

            return route('files.drives.mediaFiles.preview-version', [$this->mediaFile->file_id, $this->mediaFile->drive, $this->mediaFile, $this, $this->name]);
        }

        return route('drives.files.preview-version', [$this->mediaFile->drive, $this->mediaFile, $this, $this->name]);
    }

    public function mediaFile()
    {
        return $this->belongsTo(MediaFile::class, 'media_file_id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
