<?php


namespace App\Navigation\Link\Admin\Drives;


use App\FileStore\Drive;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Drive $drive)
    {
        parent::__construct(route('admin.drives.show', [$drive]), $drive->name);
    }
}
