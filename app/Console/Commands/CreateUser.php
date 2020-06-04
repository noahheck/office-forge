<?php

namespace App\Console\Commands;

use App\Jobs\User\Create;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'of:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user for the Office Forge installation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Dispatcher $dispatcher)
    {
        $name = $this->ask(__('commands.user.name'));
        $email = $this->ask(__('commands.user.email'));

        $timezone = $this->choice(__('commands.user.timezone'), array_values(\App\timezone_options()));
        $timezone = \App\timezone_from_description($timezone);

        $jobTitle = $this->ask(__('commands.user.job-title'));

        $firstPassTry = true;
        do {

            if (!$firstPassTry) {
                $this->error(__('commands.user.passwords-dont-match'));
            }

            $firstPassTry = false;

            $pass1 = $this->secret(__('commands.user.password'));
            $pass2 = $this->secret(__('commands.user.password-confirm'));

        } while ($pass1 !== $pass2);

        $admin = $this->confirm(__('commands.user.is-administrator'));
        $systemAdmin = $this->confirm(__('commands.user.is-system-administrator'));

        $dispatcher->dispatchNow($userCreated = new Create(
            $name,
            $email,
            $timezone,
            $jobTitle,
            $pass1,
            true,
            $admin,
            $systemAdmin
        ));

        $user = $userCreated->getUser();

        $this->info(__('commands.user.created', ['id' => $user->id . ' - ' . $user->name]));
    }
}
