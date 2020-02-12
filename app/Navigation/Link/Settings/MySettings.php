<?php


namespace App\Navigation\Link\Settings;


use App\Navigation\Link;

class MySettings extends Link
{
    public function __construct()
    {
        parent::__construct(route('my-settings.index'), __('app.mySettings'));
    }
}
