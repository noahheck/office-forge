<?php

namespace App\Jobs\Server\Updates;

use App\Server\Updates\Installer;
use App\Server\Updates\Update;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Install
{
    use Dispatchable, Queueable;

    private $update;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getUpdate(): Update
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Installer $installer)
    {
        $update = new Update();
        $update->save();// To record start time

        $installer->installUpdates();

        $update->successful = $installer->getSuccess();
        $update->output = implode("\n", $installer->getOutput());

        $update->save();

        $this->update = $update;
    }
}
