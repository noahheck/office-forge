<?php


namespace App\Navigation\LocationBar\Files\Drives\Folders;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileType;
use App\Navigation\LocationBar;

class Create extends LocationBar
{
    public function __construct(FileType $fileType, File $file, Drive $drive, Folder $newFolder)
    {
        parent::__construct(__('fileStore.newFolder'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives\Show($file, $drive));

        if ($folder = $newFolder->parentFolder) {

            $folders = collect([$folder]);

            while ($folder = $folder->parentFolder) {
                $folders->push($folder);
            }

            $folders->reverse()->each(function($folder) use ($file, $drive) {
                $this->addLink(new \App\Navigation\Link\Files\Drives\Folders\Show($file, $drive, $folder));
            });
        }
    }
}
