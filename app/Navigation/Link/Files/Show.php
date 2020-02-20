<?php


namespace App\Navigation\Link\Files;


use App\File;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(File $file)
    {
        parent::__construct(route('files.show', [$file]), $file->name);
    }
}
