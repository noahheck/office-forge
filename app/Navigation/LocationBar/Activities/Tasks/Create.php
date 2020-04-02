<?php


namespace App\Navigation\LocationBar\Activities\Tasks;


use App\Activity;
use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct(Activity $activity)
    {
        parent::__construct(__('app.addNew'));

        $this->addLink(new \App\Navigation\Link\Activities);
        $this->addLink(new \App\Navigation\Link\Activities\Show($activity));
        $this->addLink(new \App\Navigation\Link\Activities\Tasks($activity));
    }
}
