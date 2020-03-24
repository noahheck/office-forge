<?php

namespace App\Jobs\FileType\Panel;

use App\FileType;
use App\FileType\Panel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $fileType;
    private $name;

    private $panel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $name)
    {
        $this->fileType = $fileType;
        $this->name = $name;
    }

    public function getPanel(): Panel
    {
        return $this->panel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $panel = new Panel;

        $panel->file_type_id = $this->fileType->id;
        $panel->name = $this->name;

        $panel->order = $this->fileType->panels->max('order') + 1;

        $panel->save();

        $this->panel = $panel;
    }
}
