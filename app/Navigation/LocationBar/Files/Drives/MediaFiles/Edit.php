<?php


namespace App\Navigation\LocationBar\Files\Drives\MediaFiles;


use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileStore\MediaFile;
use App\FileType;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(File $file, FileType $fileType, Drive $drive, MediaFile $mediaFile)
    {
        parent::__construct(__('fileStore.editFile'));

        $this->addLink(new \App\Navigation\Link\Files);
        $this->addLink(new \App\Navigation\Link\Files\FilteredFiles($fileType));
        $this->addLink(new \App\Navigation\Link\Files\Show($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives($file));
        $this->addLink(new \App\Navigation\Link\Files\Drives\Show($file, $drive));

        if ($folder = $mediaFile->folder) {

            $folders = collect([$folder]);

            while ($folder = $folder->parentFolder) {
                $folders->push($folder);
            }

            $folders->reverse()->each(function($folder) use ($file, $drive) {
                $this->addLink(new \App\Navigation\Link\Files\Drives\Folders\Show($file, $drive, $folder));
            });
        }

        $this->addLink(new \App\Navigation\Link\Files\Drives\MediaFiles\Show($file, $drive, $mediaFile));
    }
}
