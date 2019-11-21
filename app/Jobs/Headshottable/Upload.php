<?php

namespace App\Jobs\Headshottable;

use App\HeadShot;
use App\Interfaces\Headshottable;
use App\User;
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
    public function handle(Filesystem $disk, ImageManager $imageManager)
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


        $baseImage = $imageManager->make($uploadedFile)->orientate();

        $dimensions = $this->getTargetDimensions($baseImage->width(), $baseImage->height());

        $baseImage->resize($dimensions['baseWidth'], $dimensions['baseHeight'], function($constraint) {
            $constraint->aspectRatio();
        });

        $thumbImage = $imageManager->make($uploadedFile)->orientate();
        $thumbImage->resize($dimensions['thumbWidth'], $dimensions['thumbHeight'], function($constraint) {
            $constraint->aspectRatio();
        });

        $iconImage = $imageManager->make($uploadedFile)->orientate();
        $iconImage->resize($dimensions['iconWidth'], $dimensions['iconHeight'], function($constraint) {
            $constraint->aspectRatio();
        });

        $disk->put('/headshots/' . $photoName,      (string) $baseImage->encode());
        $disk->put('/headshots/' . $thumbFileName, (string) $thumbImage->encode());
        $disk->put('/headshots/' . $iconFileName,  (string) $iconImage->encode());


        $headshot->filename       = $photoName;
        $headshot->thumb_filename = $thumbFileName;
        $headshot->icon_filename  = $iconFileName;

        $headshot->save();

        $this->headshot = $headshot;
    }






    private function getTargetDimensions($baseImageWidth, $baseImageHeight)
    {
        $baseWidth  = 500;
        $thumbWidth = 200;
        $iconWidth  = 50;

        $baseHeight  = null;
        $thumbHeight = null;
        $iconHeight  = null;

        if ($baseImageHeight > $baseImageWidth) {
            $baseWidth  = null;
            $thumbWidth = null;
            $iconWidth  = null;

            $baseHeight  = 500;
            $thumbHeight = 200;
            $iconHeight  = 50;
        }

        return [
            'baseWidth'   => $baseWidth,
            'thumbWidth'  => $thumbWidth,
            'iconWidth'   => $iconWidth,
            'baseHeight'  => $baseHeight,
            'thumbHeight' => $thumbHeight,
            'iconHeight'  => $iconHeight,
        ];
    }
}
