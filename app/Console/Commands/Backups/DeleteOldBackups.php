<?php

namespace App\Console\Commands\Backups;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class DeleteOldBackups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'of:delete-old-backups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes backups older than the configured system setting for storing backup files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Dispatcher $dispatcher)
    {
        $dispatcher->dispatchNow(new \App\Jobs\Backups\DeleteOldBackups());
    }
}
