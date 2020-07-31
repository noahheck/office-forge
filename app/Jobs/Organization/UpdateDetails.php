<?php

namespace App\Jobs\Organization;

use App\Options;
use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateDetails
{
    use Dispatchable, Queueable;

    private $name;
    private $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Options $options)
    {
        $options->set(Organization::NAME_OPTION, $this->name);
        $options->set(Organization::PHONE_OPTION, $this->phone ?? '');
    }
}
