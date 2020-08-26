<?php


namespace App\Navigation\Link\Drives\Folders;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Drive $drive, Folder $folder)
    {
        parent::__construct(route('drives.folders.show', [$drive, $folder]), $folder->name);
    }
}
