<?php

namespace App\Jobs\User;

use App\User;
use App\Utility\RandomColorGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

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
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $email,
        string $timezone,
        string $job_title,
        string $password,
        bool $active,
        bool $administrator,
        bool $system_administrator,
        array $accessKeys = []
    )
    {
        $this->name                 = $name;
        $this->email                = $email;
        $this->timezone             = $timezone;
        $this->job_title            = $job_title;
        $this->password             = $password;
        $this->active               = $active;
        $this->administrator        = $administrator;
        $this->system_administrator = $system_administrator;
        $this->accessKeys           = $accessKeys;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Hasher $hasher)
    {
        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->timezone = $this->timezone;
        $user->job_title = $this->job_title;

        $user->color = RandomColorGenerator::generateHex(RandomColorGenerator::COLOR_DARK);

        $user->password = $hasher->make($this->password);

        $user->active = $this->active;
        $user->administrator = $this->administrator;
        $user->system_administrator = $this->system_administrator;

        $user->save();

        $user->accessKeys()->sync($this->accessKeys);

        $this->user = $user;
    }
}
