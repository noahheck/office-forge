<?php

namespace App\FormDoc;

use App\FormDoc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;

    protected $table = "form_doc_fields";

    public function formDoc()
    {
        return $this->belongsTo(FormDoc::class);
    }
}
