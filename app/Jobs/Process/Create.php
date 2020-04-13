<?php

namespace App\Jobs\Process;

use App\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $file_type_id;
    private $active;
    private $details;
    private $creatingTeams;
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
    public function __construct($name, $file_type_id, $active, $details, $creatingTeams, $editor_temp_id)
    {
        $this->name = $name;
        $this->file_type_id = $file_type_id;
        $this->active = $active;
        $this->details = $details;
        $this->creatingTeams = $creatingTeams;
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
        $process->file_type_id = $this->file_type_id;
        $process->details = $this->details;
        $process->active = $this->active;

        $process->save();

        $process->claimTemporaryEditorImages($this->editor_temp_id);

        $process->creatingTeams()->sync($this->creatingTeams);

        $this->process = $process;
    }
}
