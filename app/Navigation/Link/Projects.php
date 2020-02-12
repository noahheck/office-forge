<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class Projects extends Link
{
    public function __construct()
    {
        parent::__construct(route('projects.index'), __('app.projects'));
    }
}
