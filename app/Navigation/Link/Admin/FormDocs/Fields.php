<?php


namespace App\Navigation\Link\Admin\FormDocs;


use App\FileType;
use App\FileType\Form;
use App\FormDoc;
use App\Navigation\Link;

class Fields extends Link
{
    public function __construct(FormDoc $formDoc)
    {
        parent::__construct(route('admin.form-docs.fields.index', [$formDoc]), __('formDoc.fields'));
    }
}
