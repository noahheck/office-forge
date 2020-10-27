<?php

namespace App\FileStore;

use App\File;
use App\FileType;
use App\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drive extends Model
{
    use SoftDeletes;

    protected $table = 'filestore_drives';

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'filestore_drives_teams', 'filestore_drive_id', 'team_id');
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function folders()
    {
        return $this->hasMany(Folder::class)->ordered();
    }

    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class)->ordered();
    }

    public function topLevelFolders()
    {
        return $this->hasMany(Folder::class)->whereNull(['parent_folder_id', 'file_id'])->ordered();
    }

    public function topLevelMediaFiles()
    {
        return $this->hasMany(MediaFile::class)->whereNull(['folder_id', 'file_id'])->ordered();
    }

    public function topLevelFoldersForFile(File $file)
    {
        return $this->hasMany(Folder::class)->whereNull('parent_folder_id')->where('file_id', $file->id)->ordered();
    }

    public function topLevelMediaFilesForFile(File $file)
    {
        return $this->hasMany(MediaFile::class)->whereNull('folder_id')->where('file_id', $file->id)->ordered();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}
