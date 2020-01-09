<?php


namespace App\Navigation\LocationBar\Link\Settings;


use App\Navigation\LocationBar\Link;

class MySettings extends Link
{
    public function __construct()
    {
        parent::__construct(route('my-settings.index'), __('app.mySettings'));
    }
}
