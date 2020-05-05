<?php


namespace App\Navigation\Link\Admin;


use App\FileType;
use App\Navigation\Link;

class FormDocs extends Link
{
    public function __construct()
    {
        parent::__construct(route('admin.form-docs.index'), __('file.formDocs'));
    }
}
