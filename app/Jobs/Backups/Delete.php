<?php

namespace App\Jobs\Backups;

use App\Backups\Backup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable, Queueable;

    /**
     * @var Backup
     */
    private $backup;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Backup $backup)
    {
        $this->backup = $backup;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Filesystem $disk)
    {
        $filename = $this->backup->filename;

        if ($disk->exists('/backups/' . $filename)) {

            $disk->delete('/backups/' . $filename);
        }

        $this->backup->delete();
    }
}
