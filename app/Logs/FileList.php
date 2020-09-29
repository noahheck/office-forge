<?php


namespace App\Logs;


use Illuminate\Contracts\Filesystem\Factory;

class FileList
{
    private $disk;

    public function __construct(Factory $diskFactory)
    {
        $this->disk = $diskFactory->disk('logs');
    }

    public function getLogFilesList()
    {
        $allFiles = collect($this->disk->files());

        $allFiles = $allFiles->filter(function($filename) {
            return !\Str::startsWith($filename, '.');
        })->reverse();

        return $allFiles;
    }
}
