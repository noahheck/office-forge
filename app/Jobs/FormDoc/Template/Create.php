<?php

namespace App\Jobs\FormDoc\Template;

use App\FormDoc\Template as FormDoc;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $teams;
    private $file_type_id;

    private $formDoc;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $teams, $file_type_id = null)
    {
        $this->name = $name;
        $this->teams = $teams;
        $this->file_type_id = $file_type_id;
    }

    public function getFormDoc(): FormDoc
    {
        return $this->formDoc;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $formDoc = new FormDoc();
        $formDoc->name = $this->name;
        $formDoc->active = true;
        $formDoc->file_type_id = $this->file_type_id;

        $formDoc->save();

        $formDoc->teams()->sync($this->teams);

        $this->formDoc = $formDoc;
    }
}
