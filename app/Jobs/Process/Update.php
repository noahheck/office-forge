<?php

namespace App\Jobs\Process;

use App\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $process;

    private $name;
    private $active;
    private $details;
    private $instantiatingTeams;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, $name, $active, $details, $instantiatingTeams)
    {
        $this->process = $process;

        $this->name = $name;
        $this->active = $active;
        $this->details = $details;
        $this->instantiatingTeams = $instantiatingTeams;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = $this->process;

        $process->name = $this->name;
        $process->details = $this->details;
        $process->active = $this->active;

        $process->instantiatingTeams()->sync($this->instantiatingTeams);

        $process->save();
    }
}
