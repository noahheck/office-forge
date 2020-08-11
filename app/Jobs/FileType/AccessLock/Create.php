<?php

namespace App\Jobs\FileType\AccessLock;

use App\FileType;
use App\FileType\AccessLock;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $fileType;
    private $name;
    private $details;

    private $accessLock;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $name, $details)
    {
        $this->fileType = $fileType;
        $this->name = $name;
        $this->details = $details;
    }

    public function getAccessLock(): AccessLock
    {
        return $this->accessLock;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $accessLock = new AccessLock;
        $accessLock->file_type_id = $this->fileType->id;
        $accessLock->name = $this->name;
        $accessLock->details = $this->details;

        $accessLock->save();

        $this->accessLock = $accessLock;
    }
}
