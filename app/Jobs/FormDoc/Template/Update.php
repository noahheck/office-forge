<?php

namespace App\Jobs\FormDoc\Template;

use App\FormDoc\Template as FormDoc;
use App\FormDoc\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $template;
    private $name;
    private $teams;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Template $template, $name, $teams, $active)
    {
        $this->template = $template;
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
        $template = $this->template;
        $template->name = $this->name;
        $template->active = $this->active;

        $template->save();

        $template->teams()->sync($this->teams);
    }
}
