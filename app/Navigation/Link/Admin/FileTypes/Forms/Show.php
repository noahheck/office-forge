<?php


namespace App\Navigation\Link\Admin\FileTypes\Forms;


use App\FileType;
use App\FileType\Form;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FileType $fileType, Form $form)
    {
        parent::__construct(route('admin.file-types.forms.show', [$fileType, $form]), $form->name);
    }
}
