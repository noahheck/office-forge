<?php

namespace App\Jobs\FileType;

use App\FileType;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $file;
    private $name;
    private $icon;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $file, $name, $icon, $active)
    {
        $this->file = $file;
        $this->name = $name;
        $this->icon = $icon;
        $this->active = $active;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = $this->file;
        $file->name = $this->name;
        $file->icon = $this->icon;
        $file->active = $this->active;

        $file->save();
    }
}
