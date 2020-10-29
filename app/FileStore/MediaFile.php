<?php

namespace App\FileStore;

use App\FileStore\MediaFile\Version;
use App\Interfaces\Headshottable as IsHeadshottable;
use App\Traits\Headshottable;
use App\User;
use App\Utility\MimeTypeIconFunctionMapper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFile extends Model implements IsHeadshottable
{
    use SoftDeletes,
        Headshottable;

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

    public function canPreviewInBrowser(): bool
    {
        $previewableMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
        ];

        return in_array($this->mimetype, $previewableMimeTypes);
    }

    public function icon($withClasses = [])
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['headshot', 'icon',])));

            return "<img class='" . e($classes) . "' src='" . route('headshot', [$headshot->id, 'icon', $headshot->icon_filename]) . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
        }

        return MimeTypeIconFunctionMapper::iconForMimetype($this->mimetype, $withClasses);
    }

    public function thumbnail($withClasses = [])
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['headshot', 'thumbnail',])));

            return "<img class='" . e($classes) . "' src='" . route('headshot', [$headshot->id, 'thumb', $headshot->thumb_filename]) . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
        }

        $withClasses = array_merge($withClasses, ['thumbnail']);

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

    public function versions()
    {
        return $this->hasMany(Version::class, 'media_file_id');
    }
}
