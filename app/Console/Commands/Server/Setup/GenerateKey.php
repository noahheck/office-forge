<?php

namespace App\Console\Commands\Server\Setup;

use App\Jobs\Server\Setup\GenerateKey as GenerateKeyJob;
use App\Options;
use App\Server\Setup;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class GenerateKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'of:generate-setup-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new setup key for the server';

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
    public function handle(Options $options, Dispatcher $dispatcher)
    {
        $this->line(__('commands.setup-key.generate-new-key'));

        if ($options->get(Setup::KEY_OPTION, false)) {
            $this->line(__('commands.setup-key.invalidate-existing'));

            if (!$this->confirm(__('commands.confirm-proceed'))) {
                $this->line(__('commands.exiting'));

                return;
            }
        }

        $dispatcher->dispatchNow($keyGenerated = new GenerateKeyJob());

        $newKey = $keyGenerated->getKey();

        $this->line(__('commands.setup-key.key-is'));
        $this->line("    {$newKey}");
    }
}
