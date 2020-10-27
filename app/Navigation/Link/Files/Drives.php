<?php


namespace App\Navigation\Link\Files;


use App\File;
use App\Navigation\Link;

class Drives extends Link
{
    public function __construct(File $file)
    {
        parent::__construct(route('files.drives.index', [$file]), __('fileStore.drives'));
    }
}
