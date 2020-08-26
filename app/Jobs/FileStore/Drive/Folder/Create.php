<?php

namespace App\Jobs\FileStore\Drive\Folder;

use App\FileStore\Drive;
use App\FileStore\Folder;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $drive;
    private $name;
    private $description;
    private $parentFolderId;

    private $folder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Drive $drive, $name, $description, $parentFolderId)
    {
        $this->drive = $drive;
        $this->name = $name;
        $this->description = $description;
        $this->parentFolderId = $parentFolderId;
    }

    public function getFolder(): Folder
    {
        return $this->folder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $folder = new Folder;

        $folder->drive_id = $this->drive->id;
        $folder->name = $this->name;
        $folder->description = $this->description;
        $folder->parent_folder_id = $this->parentFolderId;

        $folder->save();

        $this->folder = $folder;
    }
}
