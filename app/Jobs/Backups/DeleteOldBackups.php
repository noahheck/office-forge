<?php

namespace App\Jobs\Backups;

use App\Backups;
use App\Backups\Backup;
use App\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteOldBackups
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Options $options, Dispatcher $dispatcher)
    {
        $storageTimeOption = $options->get(Backups::STORAGE_TIME_OPTION, 30);

        // 0 is for indefinite storage of backups
        if (!$storageTimeOption) {

            return;
        }

        $dateToDeleteFrom = now()->subDays($storageTimeOption);

        $backupsToDelete = Backup::whereDate('created_at', '<', $dateToDeleteFrom)->get();

        $backupsToDelete->each(function($backup) use ($dispatcher) {

            $dispatcher->dispatchNow(new Delete($backup));
        });

    }
}
