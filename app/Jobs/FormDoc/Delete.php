<?php

namespace App\Jobs\FormDoc;

use App\FormDoc;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable, Queueable;

    private $formDoc;
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FormDoc $formDoc, User $user)
    {
        $this->formDoc = $formDoc;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->formDoc->deleted_by = $this->user->id;
        $this->formDoc->save();

        $this->formDoc->delete();
    }
}
