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
    private $creatingTeams;
    private $reviewingTeams;
    private $file_type_id;
    private $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Template $template, $name, $creatingTeams, $reviewingTeams, $file_type_id, $active)
    {
        $this->template = $template;
        $this->name = $name;
        $this->creatingTeams = $creatingTeams;
        $this->reviewingTeams = $reviewingTeams;
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

        $teamData = Template::getTeamSyncStructure($this->creatingTeams, $this->reviewingTeams);

        $template->teams()->sync($teamData);
    }

}
