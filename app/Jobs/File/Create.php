<?php

namespace App\Jobs\File;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $icon;
    private $active;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $icon, $active)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->active = $active;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = new File;
        $file->name = $this->name;
        $file->icon = $this->icon;
        $file->active = $this->active;

        $file->save();

        $this->file = $file;
    }
}
