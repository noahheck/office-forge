<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class FormDocs extends Link
{
    public function __construct()
    {
        parent::__construct(route('form-docs.index'), __('app.formDocs'));
    }
}
