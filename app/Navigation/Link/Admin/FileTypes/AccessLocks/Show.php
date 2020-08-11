<?php


namespace App\Navigation\Link\Admin\FileTypes\AccessLocks;


use App\FileType;
use App\FileType\AccessLock;
use App\FileType\Form;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FileType $fileType, AccessLock $accessLock)
    {
        parent::__construct(route('admin.file-types.access-locks.show', [$fileType, $accessLock]), $accessLock->name);
    }
}
