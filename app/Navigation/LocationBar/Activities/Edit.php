<?php


namespace App\Navigation\LocationBar\Activities;


use App\Activity;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(Activity $activity)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($activity));
    }
}
