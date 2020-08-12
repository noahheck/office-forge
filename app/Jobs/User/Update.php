<?php

namespace App\Jobs\User;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $user;
    private $name;
    private $email;
    private $timezone;
    private $job_title;
    private $password;
    private $active;
    private $administrator;
    private $system_administrator;
    private $accessKeys;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        string $name,
        string $email,
        string $timezone,
        string $job_title,
        bool $active,
        bool $administrator,
        bool $system_administrator,
        string $password = '',
        array $accessKeys = []
    ) {
        $this->user                 = $user;
        $this->name                 = $name;
        $this->email                = $email;
        $this->timezone             = $timezone;
        $this->job_title            = $job_title;
        $this->active               = $active;
        $this->administrator        = $administrator;
        $this->system_administrator = $system_administrator;
        $this->password             = $password;
        $this->accessKeys           = $accessKeys;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Hasher $hasher)
    {
        $user = $this->user;

        $user->name = $this->name;
        $user->email = $this->email;
        $user->timezone = $this->timezone;
        $user->job_title = $this->job_title;


        $user->active = $this->active;
        $user->administrator = $this->administrator;
        $user->system_administrator = $this->system_administrator;

        if ($this->password) {
            $user->password = $hasher->make($this->password);
        }

        $user->save();

        $user->accessKeys()->sync($this->accessKeys);

        $this->user = $user;
    }
}
