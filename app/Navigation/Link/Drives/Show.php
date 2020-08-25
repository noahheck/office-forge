<?php


namespace App\Navigation\Link\Drives;


use App\File;
use App\FileStore\Drive;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Drive $drive)
    {
        parent::__construct(route('drives.show', [$drive]), $drive->name);
    }
}
