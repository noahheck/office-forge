<?php

namespace App\Jobs\Server\Updates;

use App\Server\Updates;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Options;

class SaveSettings
{
    use Dispatchable, Queueable;

    private $schedule;
    private $time;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($schedule, $time)
    {
        $this->schedule = $schedule;
        $this->time = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Options $options)
    {
        $options->set(Updates::SCHEDULE_OPTION, $this->schedule);
        $options->set(Updates::TIME_OPTION, $this->time);
    }
}
