<?php


namespace App\Navigation\LocationBar\Drives\Folders;


use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(Drive $drive, Folder $folder)
    {
        parent::__construct(__('fileStore.editFolder'));

        $this->addLink(new \App\Navigation\Link\FileStore);
        $this->addLink(new \App\Navigation\Link\Drives\Show($drive));

        $folders = collect([]);

        $parentFolder = $folder;

        while ($parentFolder = $parentFolder->parentFolder) {
            $folders->push($parentFolder);
        }

        $folders->reverse()->each(function($folder) use ($drive) {
            $this->addLink(new \App\Navigation\Link\Drives\Folders\Show($drive, $folder));
        });

        $this->addLink(new \App\Navigation\Link\Drives\Folders\Show($drive, $folder));

    }
}
