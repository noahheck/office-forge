<?php


namespace App\Navigation\Link\Admin\FileTypes;


use App\FileType;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FileType $file)
    {
        parent::__construct(route('admin.file-types.show', [$file]), $file->name);
    }
}
