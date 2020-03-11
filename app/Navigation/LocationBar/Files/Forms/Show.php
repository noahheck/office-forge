<?php


namespace App\Navigation\LocationBar\Files\Forms;


use App\File;
use App\FileType;
use App\FileType\Form;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(FileType $fileType, File $file, Form $form)
    {
        parent::__construct($form->name);

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
        $this->addLink(new \App\Navigation\Link\Files\Forms($file));
    }
}
