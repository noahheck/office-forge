<?php

namespace App\Jobs\FileType\AccessLock;

use App\FileType\AccessLock;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable, Queueable;

    private $accessLock;
    private $deletedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AccessLock $accessLock, User $deletedBy)
    {
        $this->accessLock = $accessLock;
        $this->deletedBy = $deletedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->accessLock->deleted_by = $this->deletedBy->id;
        $this->accessLock->save();

        $this->accessLock->delete();
    }
}
