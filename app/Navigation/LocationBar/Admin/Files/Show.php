<?php


namespace App\Navigation\LocationBar\Admin\Files;


use App\File;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(File $file)
    {
        parent::__construct($file->name);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Files);
    }
}
