<?php

namespace App\Jobs\Process;

use App\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $active;
    private $details;
    private $editor_temp_id;

    /**
     * @var Process
     */
    private $process;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $active, $details, $editor_temp_id)
    {
        $this->name = $name;
        $this->active = $active;
        $this->details = $details;
        $this->editor_temp_id = $editor_temp_id;
    }

    public function getProcess(): Process
    {
        return $this->process;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = new Process();
        $process->name = $this->name;
        $process->details = $this->details;
        $process->active = $this->active;

        $process->save();

        $process->claimTemporaryEditorImages($this->editor_temp_id);

        $this->process = $process;
    }
}
