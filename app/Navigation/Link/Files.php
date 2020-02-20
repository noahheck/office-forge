<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class Files extends Link
{
    public function __construct()
    {
        parent::__construct(route('files.index'), __('app.files'));
    }
}
