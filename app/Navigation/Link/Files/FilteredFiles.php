<?php


namespace App\Navigation\Link\Files;


use App\FileType;
use App\Navigation\Link;
use Illuminate\Support\Str;

class FilteredFiles extends Link
{
    public function __construct(FileType $fileType)
    {
        parent::__construct(route('files.index', ['file_type' => $fileType->id]), Str::plural($fileType->name));
    }
}
