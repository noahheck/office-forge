<?php


namespace App\Navigation\LocationBar\Admin\Files;


use App\File;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(File $file)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Files);
        $this->addLink(new \App\Navigation\Link\Admin\Files\Show($file));
    }
}
