<?php

namespace App\Http\Controllers;

use App\HeadShot;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;

class HeadShotController extends Controller
{
    /**
     * @var Filesystem
     */
    private $disk;

    public function __construct(Filesystem $disk)
    {
        $this->disk = $disk;
    }

    public function photo(HeadShot $headshot, $size, $filename)
    {
        $property = 'filename';
        switch ($size):
            case 'icon':
                $property = 'icon_filename';
                break;
            case 'thumb':
                $property = 'thumb_filename';
                break;
        endswitch;

        return response()->file($this->disk->path('/headshots/' . $headshot->$property))
            ->setLastModified($headshot->created_at);
    }
}
