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
    private $file_type_id;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Template $template, $name, $teams, $file_type_id, $active)
    {
        $this->template = $template;
        $this->name = $name;
        $this->teams = $teams;
        $this->file_type_id = $file_type_id;
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

        if (is_null($template->last_created_at)) {
            $template->file_type_id = $this->file_type_id;
        }

        $template->save();

        $template->teams()->sync($this->teams);
    }
}
