<?php


namespace App\Navigation\LocationBar\Settings;


use App\Navigation\LocationBar;

class Teams extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.teams'));

        $this->addLink(new \App\Navigation\Link\Settings\MySettings);
    }
}
