<?php

namespace App\Console\Commands\Server\Updates;

use App\Jobs\Server\Updates\Install;
use App\Options;
use App\Server\Updates;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class InstallUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'of:server-install-updates {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply operating system updates';

    /**
     * Hide the command because if you can see the command at the command line, you can just run updates
     *
     * @var bool
     */
    protected $hidden = true;

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

            $schedule = $options->get(Updates::SCHEDULE_OPTION);
            $time     = $options->get(Updates::TIME_OPTION);

            if (!$this->shouldRunToday($schedule)) {
                $this->line('Updates should not run today');

                return;
            }

            if (!$this->shouldRunThisHour($time)) {
                $this->line('Updates should not run at this time');

                return;
            }
        }

        $dispatcher->dispatchNow($updatesInstalled = new Install());
    }

    private function shouldRunToday($schedule)
    {
        $today = today();
        $firstMondayOfCurrentMonth = new Carbon("first Monday of this month");

        if ($schedule === Updates::SCHEDULE_DAILY) {
            $runToday = true;
        }

        if ($schedule === Updates::SCHEDULE_WEEKLY && $today->isMonday()) {
            $runToday = true;
        }

        if ($schedule === Updates::SCHEDULE_MONTHLY && $today->is($firstMondayOfCurrentMonth)) {
            $runToday = true;
        }

        return $runToday;
    }

    private function shouldRunThisHour($scheduleTime)
    {
        $timeToRun = substr($scheduleTime, 0, 2);

        $thisHour = now()->format('H');

        return (string) $timeToRun === (string) $thisHour;
    }
}
