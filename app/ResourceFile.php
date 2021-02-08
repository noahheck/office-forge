<?php

namespace App;

use App\Interfaces\Headshottable as IsHeadshottable;
use App\Traits\Headshottable;
use App\Traits\MediaFiles\MediaFileResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceFile extends Model implements IsHeadshottable
{
    use SoftDeletes,
        Headshottable,
        MediaFileResource;

    public function resource()
    {
        return $this->morphTo();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function downloadUrl()
    {
        return route('drives.files.download', [$this->drive, $this, $this->name]);
    }

    public function previewUrl()
    {
        return route('drives.files.preview', [$this->drive, $this, $this->name]);
    }
}
