<?php

namespace App\Process;

use App\Activity;
use App\Process;
use App\User;

class ProcessProvider
{
    private $process;

    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    public function getProcessesCreatableByUser(User $user, $fileTypeId = null)
    {
        $processes = $this->process->active()->where('file_type_id', $fileTypeId)->orderBy('name')->get();

        $processes->load('creatingTeams');

        return $processes->filter(function($process, $key) use ($user) {

            return $user->can('create', [Activity::class, $process]);
        });
    }
}
