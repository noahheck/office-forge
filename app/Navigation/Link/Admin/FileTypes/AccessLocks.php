<?php


namespace App\Navigation\Link\Admin\FileTypes;


use App\FileType;
use App\Navigation\Link;

class AccessLocks extends Link
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(route('admin.file-types.access-locks.index', [$fileType]), __('admin.accessLocks'));
    }
}
