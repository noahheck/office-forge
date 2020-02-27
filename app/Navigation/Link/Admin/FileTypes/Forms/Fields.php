<?php


namespace App\Navigation\Link\Admin\FileTypes\Forms;


use App\FileType;
use App\FileType\Form;
use App\Navigation\Link;

class Fields extends Link
{
    public function __construct(FileType $fileType, Form $form)
    {
        parent::__construct(route('admin.file-types.forms.fields.index', [$fileType, $form]), __('file.fields'));
    }
}
