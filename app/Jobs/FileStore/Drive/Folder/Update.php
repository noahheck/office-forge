<?php

namespace App\Jobs\FileStore\Drive\Folder;

use App\FileStore\Folder;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $folder;
    private $name;
    private $description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Folder $folder, $name, $description)
    {
        $this->folder = $folder;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $folder = $this->folder;

        $folder->name = $this->name;
        $folder->description = $this->description;

        $folder->save();
    }
}
