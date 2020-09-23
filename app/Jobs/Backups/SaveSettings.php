<?php

namespace App\Jobs\Backups;

use App\Backups;
use App\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveSettings
{
    use Dispatchable, Queueable;

    private $time;
    private $storageTime;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($time, $storageTime)
    {
        $this->time = $time;
        $this->storageTime = (int) $storageTime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Options $options)
    {
        $options->set(Backups::TIME_OPTION, $this->time);
        $options->set(Backups::STORAGE_TIME_OPTION, $this->storageTime);
    }
}
