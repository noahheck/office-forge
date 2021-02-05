<?php

namespace App\Jobs\ResourceFile;

use App\Jobs\Headshottable\Upload;
use App\ResourceFile;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Filesystem\Filesystem;

class Create
{
    use Dispatchable, Queueable;

    private $resource_type;
    private $resource_id;
    private $file;
    private $uploaded_by;

    private $resourceFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $resource_type,
        $resource_id,
        UploadedFile $file,
        User $uploaded_by
    ) {
        $this->resource_type = $resource_type;
        $this->resource_id = $resource_id;
        $this->file = $file;
        $this->uploaded_by = $uploaded_by;
    }

    public function getResourceFile(): ResourceFile
    {
        return $this->resourceFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Filesystem $filesystem, Dispatcher $dispatcher)
    {
        $dotExtension = ($extension = $this->file->getClientOriginalExtension()) ? '.' . $extension : '';

        $resourceFile = new ResourceFile;
        $resourceFile->resource_type = $this->resource_type;
        $resourceFile->resource_id = $this->resource_id;

        $resourceFile->name = $this->file->getClientOriginalName();
        $resourceFile->mimetype = $this->file->getMimeType();
        $resourceFile->original_filename = $this->file->getClientOriginalName();
        $resourceFile->filesize = $this->file->getSize();

        $resourceFile->uploaded_by = $this->uploaded_by->id;

        $resourceFile->save();

        $filename = $resourceFile->id . $dotExtension;
        $resourceFile->filename = $filename;

        $resourceFile->save();

        $this->resourceFile = $resourceFile;

        $filesystem->putFileAs(DIRECTORY_SEPARATOR . 'resource-files' . DIRECTORY_SEPARATOR, $this->file, $filename);

        if (in_array($resourceFile->mimetype, ['image/jpeg', 'image/png'])) {

            $dispatcher->dispatchNow($headshotHandled = new Upload(
                $resourceFile,
                $this->file,
                $this->uploaded_by
            ));

        }
    }
}
