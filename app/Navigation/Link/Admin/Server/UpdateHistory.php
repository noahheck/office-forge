<?php


namespace App\Navigation\Link\Admin\Server;


use App\Navigation\Link;
use App\Team;

class UpdateHistory extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.server.updates.history'), __('admin.server_updateHistory'));
    }
}
