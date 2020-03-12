<?php

namespace App\Jobs\FileType\Form;

use App\FileType\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $form;
    private $name;
    private $teams;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Form $form, $name, $teams, $active)
    {
        $this->form = $form;
        $this->name = $name;
        $this->teams = $teams;
        $this->active = $active;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $form = $this->form;
        $form->name = $this->name;
        $form->active = $this->active;

        $form->teams()->sync($this->teams);

        $form->save();
    }
}
