<?php


namespace App\Navigation\LocationBar\Link;


use App\Navigation\LocationBar\Link;

class Projects extends Link
{
    public function __construct()
    {
        parent::__construct(route('projects.index'), __('app.projects'));
    }
}
