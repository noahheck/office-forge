<?php


namespace App\Navigation\LocationBar\Drives\MediaFiles;


use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\Navigation\LocationBar;

class Show extends LocationBar
{
    public function __construct(Drive $drive, MediaFile $file)
    {
        parent::__construct($file->name);

        $this->addLink(new \App\Navigation\Link\FileStore);
        $this->addLink(new \App\Navigation\Link\Drives\Show($drive));

        if ($folder = $file->folder) {

            $folders = collect([$folder]);

            while ($folder = $folder->parentFolder) {
                $folders->push($folder);
            }

            $folders->reverse()->each(function($folder) use ($drive) {
                $this->addLink(new \App\Navigation\Link\Drives\Folders\Show($drive, $folder));
            });
        }

    }
}
