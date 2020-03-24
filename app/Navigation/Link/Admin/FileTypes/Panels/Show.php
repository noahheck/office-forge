<?php


namespace App\Navigation\Link\Admin\FileTypes\Panels;


use App\FileType;
use App\FileType\Form;
use App\FileType\Panel;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FileType $fileType, Panel $panel)
    {
        parent::__construct(route('admin.file-types.panels.show', [$fileType, $panel]), $panel->name);
    }
}
