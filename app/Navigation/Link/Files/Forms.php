<?php


namespace App\Navigation\Link\Files;


use App\File;
use App\Navigation\Link;

class Forms extends Link
{
    public function __construct(File $file)
    {
        parent::__construct(route('files.forms.index', [$file]), __('file.forms'));
    }
}
