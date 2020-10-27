<?php

namespace App\Jobs\FileStore\Drive\MediaFile;

use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\Jobs\Headshottable\Upload;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;

class Create
{
    use Dispatchable, Queueable;

    private $drive;
    private $folder_id;
    private $file;
    private $name;
    private $description;
    private $uploaded_by;
    private $file_id;

    private $mediaFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Drive $drive, $folder_id, UploadedFile $file, $name, $description, User $uploaded_by, $file_id = null)
    {
        $this->drive = $drive;
        $this->folder_id = $folder_id;
        $this->file = $file;
        $this->name = $name;
        $this->description = $description;
        $this->uploaded_by = $uploaded_by;
        $this->file_id = $file_id;
    }

    public function getMediaFile(): MediaFile
    {
        return $this->mediaFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Filesystem $filesystem, Dispatcher $dispatcher)
    {
        $dotExtension = ($extension = $this->file->getClientOriginalExtension()) ? '.' . $extension : '';
        $name = $this->name . $dotExtension;

        $mediaFile = new MediaFile;
        $mediaFile->drive_id = $this->drive->id;
        $mediaFile->file_id = $this->file_id;
        $mediaFile->folder_id = $this->folder_id;
        $mediaFile->name = $name;
        $mediaFile->description = $this->description;
        $mediaFile->uploaded_by = $this->uploaded_by->id;

        $mediaFile->mimetype = $this->file->getMimeType();
        $mediaFile->original_filename = $this->file->getClientOriginalName();
        $mediaFile->filesize = $this->file->getSize();

        $mediaFile->save();

        $filename = $mediaFile->id . $dotExtension;
        $mediaFile->filename = $filename;

        $mediaFile->save();

        $filesystem->putFileAs(DIRECTORY_SEPARATOR . 'media-files' . DIRECTORY_SEPARATOR, $this->file, $filename);

        $this->mediaFile = $mediaFile;

        if (in_array($mediaFile->mimetype, ['image/jpeg', 'image/png'])) {

            $dispatcher->dispatchNow($headshotHandled = new Upload(
                $mediaFile,
                $this->file,
                $this->uploaded_by
            ));

        }
    }
}
