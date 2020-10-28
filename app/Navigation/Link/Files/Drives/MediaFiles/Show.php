<?php


namespace App\Navigation\Link\Files\Drives\MediaFiles;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileStore\MediaFile;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(File $file, Drive $drive, MediaFile $mediaFile)
    {
        parent::__construct(route('files.drives.mediaFiles.show', [$file, $drive, $mediaFile]), $mediaFile->name);
    }
}
