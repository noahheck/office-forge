<?php


namespace App\Navigation\LocationBar\Admin\Backups;


use App\Backups\Backup;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(Backup $backup)
    {
        parent::__construct(\App\format_datetime($backup->started));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Backups);
    }
}
