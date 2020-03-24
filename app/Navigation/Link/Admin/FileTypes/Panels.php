<?php


namespace App\Navigation\Link\Admin\FileTypes;


use App\FileType;
use App\Navigation\Link;

class Panels extends Link
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(route('admin.file-types.panels.index', [$fileType]), __('admin.panels'));
    }
}
