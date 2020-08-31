<?php


namespace App\Navigation\LocationBar\Drives\MediaFiles;


use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\Navigation\LocationBar;

class Edit extends LocationBar
{
    public function __construct(Drive $drive, MediaFile $file)
    {
        parent::__construct(__('app.edit'));

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

        $this->addLink(New \App\Navigation\Link\Drives\MediaFile\Show($drive, $file));

    }
}
