<?php

namespace App\Jobs\FormDoc\Template;

use App\FormDoc\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $name;
    private $teams;
    private $file_type_id;

    private $template;

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

    public function getTemplate(): Template
    {
        return $this->template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $template = new Template();
        $template->name = $this->name;
        $template->active = true;
        $template->file_type_id = $this->file_type_id;

        $template->save();

        $template->teams()->sync($this->teams);

        $this->template = $template;
    }
}
