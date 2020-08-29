<?php


namespace App\Navigation\Link\Drives\MediaFile;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileStore\MediaFile;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Drive $drive, MediaFile $mediaFile)
    {
        parent::__construct(route('drives.files.show', [$drive, $mediaFile]), $mediaFile->name);
    }
}
