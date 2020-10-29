<?php

namespace App\FileStore\MediaFile;

use App\FileStore\MediaFile;
use App\Traits\Headshottable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
//    use Headshottable;

    protected $table = 'filestore_media_file_versions';

    public function mediaFile()
    {
        return $this->belongsTo(MediaFile::class, 'media_file_id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
