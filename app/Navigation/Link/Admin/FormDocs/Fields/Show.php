<?php


namespace App\Navigation\Link\Admin\FormDocs\Fields;


use App\FormDoc\Template;
use App\FormDoc\Template\Field;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(Template $formDoc, Field $field)
    {
        parent::__construct(route('admin.form-docs.fields.show', [$formDoc, $field]), $field->label);
    }
}
