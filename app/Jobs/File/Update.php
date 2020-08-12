<?php

namespace App\Jobs\File;

use App\File;
use App\FileType;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $file;
    private $name;
    private $accessLocks;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $file, $name, $accessLocks)
    {
        $this->file = $file;
        $this->name = $name;
        $this->accessLocks = $accessLocks;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = $this->file;
        $file->name = $this->name;

        $file->save();

        $file->accessLocks()->sync($this->accessLocks);
    }
}
