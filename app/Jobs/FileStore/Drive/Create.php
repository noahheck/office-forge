<?php

namespace App\Jobs\FileStore\Drive;

use App\FileStore\Drive;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $description;
    private $teams;
    private $file_type_id;

    private $drive;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $description, $teams, $file_type_id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->teams = $teams;
        $this->file_type_id = $file_type_id;
    }

    public function getDrive(): Drive
    {
        return $this->drive;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $drive = new Drive;
        $drive->name = $this->name;
        $drive->description = $this->description;
        $drive->file_type_id = $this->file_type_id;

        $drive->save();

        $drive->teams()->sync($this->teams);

        $this->drive = $drive;
    }
}
