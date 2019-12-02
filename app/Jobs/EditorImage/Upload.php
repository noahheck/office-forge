<?php

namespace App\Jobs\EditorImage;

use App\EditorImage;
use App\User;
use App\Utility\ImageResizer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;

class Upload implements ShouldQueue
{
    use Dispatchable, Queueable;

    private $file;
    private $resource_type;
    private $resource_id;
    private $resource_temp_id;
    private $uploadedBy;

    private $editorImage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UploadedFile $file, $resource_type, $resource_id, $resource_temp_id, User $uploadedBy)
    {
        $this->file = $file;
        $this->resource_type = $resource_type;
        $this->resource_id = $resource_id;
        $this->resource_temp_id = $resource_temp_id;
        $this->uploadedBy = $uploadedBy;
    }

    public function getEditorImage(): EditorImage
    {
        return $this->editorImage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageResizer $resizer, Filesystem $disk)
    {
        $editorImage = new EditorImage();

        $file = $this->file;

        $extension = $file->getClientOriginalExtension();

        $editorImage->type = $file->getMimeType();
        $editorImage->original_filename = $file->getClientOriginalName();
        $editorImage->resource_type = $this->resource_type;
        $editorImage->resource_id = $this->resource_id;

        if (!$editorImage->resource_id) {
            $editorImage->resource_temp_id = $this->resource_temp_id;
        }

        $editorImage->uploaded_by = $this->uploadedBy->id;

        $editorImage->save();

        $filename = $editorImage->id . '.' . $extension;

        $editorImage->filename = $filename;

        $editorImage->save();

        $resizedFile = $resizer->resizeImageToMaxSize($file, EditorImage::FILE_MAX_HEIGHT, EditorImage::FILE_MAX_WIDTH);

        $disk->put(DIRECTORY_SEPARATOR . 'editor-images' . DIRECTORY_SEPARATOR . $filename, (string) $resizedFile->encode());

        $this->editorImage = $editorImage;
    }
}
