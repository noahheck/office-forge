<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class Activities extends Link
{
    public function __construct()
    {
        parent::__construct(route('activities.index'), __('app.activities'));
    }
}
