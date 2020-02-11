<?php


namespace App\Navigation\LocationBar\Link\SystemSettings\Files;


use App\File;
use App\Navigation\LocationBar\Link;

class Show extends Link
{
    public function __construct(File $file)
    {
        parent::__construct(route('admin.files.show', [$file]), $file->name);
    }
}
