<?php

namespace App\Jobs\FileType;

use App\FileType;
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

    public function getFile(): FileType
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
        $file = new FileType;
        $file->name = $this->name;
        $file->icon = $this->icon;
        $file->active = $this->active;

        $file->save();

        $this->file = $file;
    }
}
