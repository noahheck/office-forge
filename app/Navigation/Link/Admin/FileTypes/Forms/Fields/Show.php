<?php


namespace App\Navigation\Link\Admin\FileTypes\Forms\Fields;


use App\FileType;
use App\FileType\Form;
use App\FileType\Form\Field;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FileType $fileType, Form $form, Field $field)
    {
        parent::__construct(route('admin.file-types.forms.fields.show', [$fileType, $form, $field]), $field->label);
    }
}
