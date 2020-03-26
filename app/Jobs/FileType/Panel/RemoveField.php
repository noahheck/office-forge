<?php

namespace App\Jobs\FileType\Panel;

use App\FileType\Panel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class RemoveField
{
    use Dispatchable, Queueable;

    private $panel;
    private $fieldId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Panel $panel, $fieldId)
    {
        $this->panel = $panel;
        $this->fieldId = $fieldId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->panel->fields()->detach($this->fieldId);

        // Reorder remaining fields ?
    }
}
