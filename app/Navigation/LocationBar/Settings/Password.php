<?php


namespace App\Navigation\LocationBar\Settings;


use App\Navigation\LocationBar;

class Password extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('settings.password'));

        $this->addLink(new \App\Navigation\Link\Settings\MySettings);
    }
}
