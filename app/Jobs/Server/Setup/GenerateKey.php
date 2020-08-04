<?php

namespace App\Jobs\Server\Setup;

use App\Options;
use App\Server\Setup;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;

class GenerateKey
{
    use Dispatchable, Queueable;

    private $newKey;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getKey()
    {
        return $this->newKey;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Options $options, Str $str)
    {
        $newKey = $str->random(40);

        $options->set(Setup::KEY_OPTION, $newKey);

        $this->newKey = $newKey;
    }
}
