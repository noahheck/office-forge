<?php


namespace App\Navigation\LocationBar\Files\Drives\Folders;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileType;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(File $file, FileType $fileType, Drive $drive, Folder $folder)
    {
        parent::__construct($folder->name);

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives\Show($file, $drive));


        $folders = collect([]);

        $parentFolder = $folder;

        while ($parentFolder = $parentFolder->parentFolder) {
            $folders->push($parentFolder);
        }

        $folders->reverse()->each(function($folder) use ($file, $drive) {
            $this->addLink(new \App\Navigation\Link\Files\Drives\Folders\Show($file, $drive, $folder));
        });

    }
}
