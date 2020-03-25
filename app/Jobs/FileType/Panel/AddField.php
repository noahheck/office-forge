<?php

namespace App\Jobs\FileType\Panel;

use App\FileType\Panel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class AddField
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
        $curMaxOrder = $this->panel->fields->max('pivot.order');

        $this->panel->fields()->attach($this->fieldId, ['order' => $curMaxOrder + 1]);
    }
}
