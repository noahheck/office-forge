<?php


namespace App\Navigation\Link\Drives;


use App\File;
use App\FileStore\Drive;
use App\Navigation\Link;

class Folders extends Link
{
    public function __construct(Drive $drive)
    {
        parent::__construct(route('drives.folders.index', [$drive]), __('fileStore.folders'));
    }
}
