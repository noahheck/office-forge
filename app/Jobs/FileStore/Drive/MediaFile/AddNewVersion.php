<?php

namespace App\Jobs\FileStore\Drive\MediaFile;

use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\FileStore\MediaFile\Version;
use App\Jobs\Headshottable\Upload;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;

class AddNewVersion
{
    use Dispatchable, Queueable;

    private $mediaFile;
    private $file;
    private $name;
    private $description;
    private $uploaded_by;
    private $file_id;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        MediaFile $mediaFile,
        UploadedFile $file,
        $name,
        $description,
        User $uploaded_by,
        $file_id = null
    ) {
        $this->mediaFile = $mediaFile;
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

        $mediaFile = $this->mediaFile;
        $mediaFile->name = $name;
        $mediaFile->description = $this->description;
        $mediaFile->uploaded_by = $this->uploaded_by->id;

        $mediaFile->mimetype = $this->file->getMimeType();
        $mediaFile->original_filename = $this->file->getClientOriginalName();
        $mediaFile->filesize = $this->file->getSize();

        $mediaFile->save();

        $numVersions = $mediaFile->versions()->count();

        $nextVersion = $numVersions + 1;

        $filename = $mediaFile->id . '_' . $nextVersion . $dotExtension;

        $mediaFile->filename = $filename;

        $mediaFile->save();

        $filesystem->putFileAs(DIRECTORY_SEPARATOR . 'media-files' . DIRECTORY_SEPARATOR, $this->file, $filename);

        if ($currentHeadShot = $mediaFile->currentHeadshot()) {
            $currentHeadShot->current = false;
            $currentHeadShot->save();
        }

        $mediaFile->versions()->update([
            'current_version' => false
        ]);

        $version = new Version();
        $version->media_file_id = $mediaFile->id;
        $version->uploaded_by = $mediaFile->uploaded_by;
        $version->name = $mediaFile->name;
        $version->mimetype = $mediaFile->mimetype;
        $version->filename = $mediaFile->filename;
        $version->original_filename = $mediaFile->original_filename;
        $version->filesize = $mediaFile->filesize;
        $version->current_version = true;

        $version->save();

        if (in_array($mediaFile->mimetype, ['image/jpeg', 'image/png'])) {

            $dispatcher->dispatchNow($headshotHandled = new Upload(
                $mediaFile,
                $this->file,
                $this->uploaded_by
            ));

            $dispatcher->dispatchNow($headshotHandled = new Upload(
                $version,
                $this->file,
                $this->uploaded_by
            ));

        }
    }
}
