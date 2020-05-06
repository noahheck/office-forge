<?php


namespace App\Navigation\Link\Admin\FormDocs\Fields;


use App\FormDoc;
use App\FormDoc\Field;
use App\Navigation\Link;
use App\Process;
use App\Process\Task;

class Show extends Link
{
    public function __construct(FormDoc $formDoc, Field $field)
    {
        parent::__construct(route('admin.form-docs.fields.show', [$formDoc, $field]), $field->label);
    }
}
