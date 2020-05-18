<?php

namespace App\Jobs\Process\Template;

use App\FormDoc\Template;
use App\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Remove
{
    use Dispatchable, Queueable;

    private $process;
    private $template;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Process $process, Template $template)
    {
        $this->process = $process;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->process->templates()->detach($this->template);
    }
}
