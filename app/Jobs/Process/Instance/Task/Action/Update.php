<?php

namespace App\Jobs\Process\Instance\Task\Action;

use App\Process\Instance\Task\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $action;
    private $completed;
    private $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Action $action, $completed, $details)
    {
        $this->action = $action;
        $this->completed = $completed;
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $action = $this->action;

        $action->completed = $this->completed;
        $action->details = $this->details;

        $action->save();
    }
}
