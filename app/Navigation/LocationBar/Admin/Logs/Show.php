<?php


namespace App\Navigation\LocationBar\Admin\Logs;


use App\Backups\Backup;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct($logFile)
    {
        parent::__construct($logFile);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Logs);
    }
}
