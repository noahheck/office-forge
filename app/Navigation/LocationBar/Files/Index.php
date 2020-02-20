<?php


namespace App\Navigation\LocationBar\Files;


use App\FileType;
use App\Navigation\Link\Files;
use App\Navigation\LocationBar;
use Illuminate\Support\Str;

class Index extends LocationBar
{
    public function __construct(FileType $fileType = null)
    {
        if ($fileType) {
            parent::__construct(Str::plural($fileType->name));
            $this->addLink(new Files);

            return;
        }

        parent::__construct(__('app.files'));
    }
}
