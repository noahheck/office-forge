<?php

namespace App\Jobs\Headshottable;

use App\HeadShot;
use App\Interfaces\Headshottable;
use App\User;
use App\Utility\ImageResizer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

class Upload
{
    use Dispatchable, Queueable;

    /**
     * @var Headshottable
     */
    private $headshottable;

    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * @var User
     */
    private $uploadedBy;

    /**
     * @var HeadShot
     */
    private $headshot;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Headshottable $headshottable, UploadedFile $uploadedFile, User $uploadedBy)
    {
        $this->headshottable = $headshottable;
        $this->uploadedFile  = $uploadedFile;
        $this->uploadedBy    = $uploadedBy;
    }

    public function getHeadShot(): HeadShot
    {
        return $this->headshot;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Filesystem $disk, ImageResizer $imageResizer)
    {
        $headshottable = $this->headshottable;
        $uploadedFile  = $this->uploadedFile;
        $uploadedBy    = $this->uploadedBy;

        $extension = $uploadedFile->getClientOriginalExtension();

        $currentHeadShot = $headshottable->currentHeadshot();

        $headshot = new HeadShot;
        $headshot->headshottable_type = get_class($headshottable);
        $headshot->headshottable_id   = $headshottable->id;

        $headshot->current           = true;
        $headshot->original_filename = $uploadedFile->getClientOriginalName();
        $headshot->type              = $uploadedFile->getMimeType();
        $headshot->extension         = $extension;

        $headshot->uploaded_by = $uploadedBy->id;

        $headshot->save();

        // If we make it here, we'll set the formerly current headshot as no longer current
        if ($currentHeadShot) {
            $currentHeadShot->current = false;
            $currentHeadShot->save();
        }

        $baseFileName = $headshot->id;


        $photoName     = $baseFileName . '.'           . $extension;
        $thumbFileName = $baseFileName . '.thumbnail.' . $extension;
        $iconFileName  = $baseFileName . '.icon.'      . $extension;

        $baseImage  = $imageResizer->resizeImageToMaxSize($uploadedFile, HeadShot::MAX_BASE_HEIGHT, HeadShot::MAX_BASE_WIDTH);
        $thumbImage = $imageResizer->resizeImageToMaxSize($uploadedFile, HeadShot::MAX_THUMB_HEIGHT, HeadShot::MAX_THUMB_WIDTH);
        $iconImage  = $imageResizer->resizeImageToMaxSize($uploadedFile, HeadShot::MAX_ICON_HEIGHT, HeadShot::MAX_ICON_WIDTH);

        $disk->put(DIRECTORY_SEPARATOR . 'headshots' . DIRECTORY_SEPARATOR . $photoName,      (string) $baseImage->encode());
        $disk->put(DIRECTORY_SEPARATOR . 'headshots' . DIRECTORY_SEPARATOR . $thumbFileName, (string) $thumbImage->encode());
        $disk->put(DIRECTORY_SEPARATOR . 'headshots' . DIRECTORY_SEPARATOR . $iconFileName,  (string) $iconImage->encode());


        $headshot->filename       = $photoName;
        $headshot->thumb_filename = $thumbFileName;
        $headshot->icon_filename  = $iconFileName;

        $headshot->save();

        $this->headshot = $headshot;
    }
}
