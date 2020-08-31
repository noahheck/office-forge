<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class FileStore extends Link
{
    public function __construct()
    {
        parent::__construct(route('drives.index'), __('app.fileStore'));
    }
}
