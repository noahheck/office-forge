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
    private $file_id;

    private $folder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Drive $drive, $name, $description, $parentFolderId, $file_id = null)
    {
        $this->drive = $drive;
        $this->name = $name;
        $this->description = $description;
        $this->parentFolderId = $parentFolderId;
        $this->file_id = $file_id;
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
        $folder->file_id = $this->file_id;
        $folder->name = $this->name;
        $folder->description = $this->description;
        $folder->parent_folder_id = $this->parentFolderId;

        $folder->save();

        $this->folder = $folder;
    }
}
