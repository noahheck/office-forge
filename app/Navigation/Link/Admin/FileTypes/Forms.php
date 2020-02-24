<?php


namespace App\Navigation\Link\Admin\FileTypes;


use App\FileType;
use App\Navigation\Link;

class Forms extends Link
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(route('admin.file-types.forms.index', [$fileType]), __('admin.forms'));
    }
}
