<?php


namespace App\Navigation\LocationBar\Projects;


use App\Navigation\LocationBar;
use App\Project;

class Edit extends LocationBar
{
    public function __construct(Project $project)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Projects);
        $this->addLink(new \App\Navigation\Link\Projects\Show($project));
    }
}
