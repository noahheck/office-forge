<?php


namespace App\Navigation\LocationBar\Reports;


use App\Navigation\LocationBar;

class Index extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('app.reports'));
    }
}
