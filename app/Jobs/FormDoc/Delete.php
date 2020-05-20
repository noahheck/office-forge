<?php

namespace App\Jobs\FormDoc;

use App\FormDoc;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable, Queueable;

    private $formDoc;
    private $deletedBy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FormDoc $formDoc, User $deletedBy)
    {
        $this->formDoc = $formDoc;
        $this->deletedBy = $deletedBy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Dispatcher $dispatcher)
    {
        // We can do the delete directly here, rather than calling delete on each model, because we don't and won't have
        // a way to delete fields independently of the FormDoc itself
        $this->formDoc->fields()->update([
            'deleted_by' => $this->deletedBy->id,
            'deleted_at' => now(),
        ]);

        $this->formDoc->deleted_by = $this->deletedBy->id;
        $this->formDoc->save();

        $this->formDoc->delete();
    }
}
