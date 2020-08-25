<?php


namespace App\Navigation\LocationBar\Drives;


use App\FileStore\Drive;
use App\FormDoc;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(Drive $drive)
    {
        parent::__construct($drive->name);

        $this->addLink(new \App\Navigation\Link\FileStore);
    }
}
