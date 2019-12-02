<?php

namespace App\Utility;

use Intervention\Image\ImageManager;

class ImageResizer
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function resizeImageToMaxSize($imageFile, $maxHeight, $maxWidth)
    {
        $baseImage       = $this->imageManager->make($imageFile)->orientate();
        $baseImageWidth  = $baseImage->width();
        $baseImageHeight = $baseImage->height();

        if ($baseImageWidth < $maxWidth && $baseImageHeight < $maxHeight) {
            return $baseImage;
        }

        $targetWidth  = $maxWidth;
        $targetHeight = null;

        // Resize the height proportion
        if ($baseImageHeight > $baseImageWidth) {
            $targetWidth = null;
            $targetHeight = $maxHeight;
        }

        $baseImage->resize($targetWidth, $targetHeight, function($constraint) {
            $constraint->aspectRatio();
        });

        return $baseImage;
    }
}
