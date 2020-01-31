<?php

namespace App\Jobs\Process\Instance;

use App\Process\Instance;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $instance;
    private $name;
    private $details;
    private $owner_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Instance $instance, $name, $details, $owner_id)
    {
        $this->instance = $instance;
        $this->name = $name;
        $this->details = $details;
        $this->owner_id = $owner_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $instance = $this->instance;

        $instance->owner_id = $this->owner_id;
        $instance->name = $this->name;
        $instance->details = $this->details;

        $instance->save();
    }
}
