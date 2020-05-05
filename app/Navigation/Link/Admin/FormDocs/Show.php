<?php


namespace App\Navigation\Link\Admin\FormDocs;


use App\FormDoc;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FormDoc $formDoc)
    {
        parent::__construct(route('admin.form-docs.show', [$formDoc]), $formDoc->name);
    }
}
