<?php


namespace App\Navigation\Link\Admin\FormDocs;


use App\FormDoc\Template;
use App\Navigation\Link;

class Fields extends Link
{
    public function __construct(Template $formDoc)
    {
        parent::__construct(route('admin.form-docs.fields.index', [$formDoc]), __('formDoc.fields'));
    }
}
