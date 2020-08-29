<?php

namespace App\Jobs\FileStore\Drive\MediaFile;

use App\FileStore\MediaFile;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $file;
    private $name;
    private $description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MediaFile $file, $name, $description)
    {
        $this->file = $file;
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
        $file = $this->file;

        $extension = $file->extension;

        $file->name = $this->name . $extension;
        $file->description = $this->description;

        $file->save();
    }
}
