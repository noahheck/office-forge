<?php


namespace App\Navigation\LocationBar\Settings;


use App\Navigation\LocationBar;

class Photo extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('settings.photo'));

        $this->addLink(new \App\Navigation\Link\Settings\MySettings);
    }
}
