<?php


namespace App\Navigation\Link\FormDocs;


use App\Activity;
use App\FormDoc;
use App\Navigation\Link;

class Show extends Link
{
    public function __construct(FormDoc $formDoc)
    {
        parent::__construct(route('form-docs.show', [$formDoc]), $formDoc->name);
    }
}
