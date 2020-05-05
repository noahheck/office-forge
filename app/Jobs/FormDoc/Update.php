<?php

namespace App\Jobs\FormDoc;

use App\FormDoc;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $formDoc;
    private $name;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FormDoc $formDoc, $name, $active)
    {
        $this->formDoc = $formDoc;
        $this->name = $name;
        $this->active = $active;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $formDoc = $this->formDoc;
        $formDoc->name = $this->name;
        $formDoc->active = $this->active;

        $formDoc->save();
    }
}
