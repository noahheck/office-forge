<?php


namespace App\Navigation\Link\Files\Drives\Folders;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(File $file, Drive $drive, Folder $folder)
    {
        parent::__construct(route('files.drives.folders.show', [$file, $drive, $folder]), $folder->name);
    }
}
