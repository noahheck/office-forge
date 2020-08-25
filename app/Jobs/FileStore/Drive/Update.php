<?php

namespace App\Jobs\FileStore\Drive;

use App\FileStore\Drive;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $drive;
    private $name;
    private $description;
    private $teams;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Drive $drive, $name, $description, $teams = [])
    {
        $this->drive = $drive;
        $this->name = $name;
        $this->description = $description;
        $this->teams = $teams;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $drive = $this->drive;

        $drive->name = $this->name;
        $drive->description = $this->description;

        $drive->save();

        $drive->teams()->sync($this->teams);
    }
}
