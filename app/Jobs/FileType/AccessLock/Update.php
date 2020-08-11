<?php

namespace App\Jobs\FileType\AccessLock;

use App\FileType\AccessLock;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $accessLock;
    private $name;
    private $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AccessLock $accessLock, $name, $details)
    {
        $this->accessLock = $accessLock;
        $this->name = $name;
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $accessLock = $this->accessLock;
        $accessLock->name = $this->name;
        $accessLock->details = $this->details;

        $accessLock->save();
    }
}
