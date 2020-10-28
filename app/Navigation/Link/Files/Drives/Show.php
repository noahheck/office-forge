<?php


namespace App\Navigation\Link\Files\Drives;


use App\File;
use App\FileStore\Drive;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(File $file, Drive $drive)
    {
        parent::__construct(route('files.drives.show', [$file, $drive]), $drive->name);
    }
}
