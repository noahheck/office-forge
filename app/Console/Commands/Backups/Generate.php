<?php

namespace App\Console\Commands\Backups;

use App\Backups;
use App\Options;
use App\Traits\Commands\HasScheduledHourlyTime;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class Generate extends Command
{
    use HasScheduledHourlyTime;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'of:generate-backup {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new database backup file';

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
    public function handle(Options $options, Dispatcher $dispatcher)
    {
        if (!$this->option('force')) {
            $scheduleTime = $options->get(Backups::TIME_OPTION);

            if (!$this->shouldRunThisHour($scheduleTime)) {
                $this->line('Updates should not run at this time');

                return;
            }
        }

        $dispatcher->dispatchNow($backupGenerate = new \App\Jobs\Backups\Generate());
    }
}
