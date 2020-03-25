<?php

namespace App\Jobs\FileType\Panel;

use App\FileType\Panel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $panel;
    private $name;
    private $teams;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Panel $panel, $name, $teams)
    {
        $this->panel = $panel;
        $this->name = $name;
        $this->teams = $teams;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $panel = $this->panel;
        $panel->name = $this->name;

        $panel->teams()->sync($this->teams);

        $panel->save();
    }
}
