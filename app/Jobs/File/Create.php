<?php

namespace App\Jobs\File;

use App\File;
use App\FileType;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $fileType;
    private $name;
    private $accessLocks;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $name, $accessLocks)
    {
        $this->fileType = $fileType;
        $this->name = $name;
        $this->accessLocks = $accessLocks;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = new File;
        $file->file_type_id = $this->fileType->id;
        $file->name = $this->name;

        $file->save();

        $file->accessLocks()->sync($this->accessLocks);

        $this->file = $file;
    }
}
