<?php

namespace App\Jobs\Process\Instance\Task\Action;

use App\Process\Instance\Task\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Uncomplete
{
    use Dispatchable, Queueable;

    private $action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->action->completed = false;

        $this->action->save();
    }
}
