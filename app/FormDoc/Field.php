<?php

namespace App\FormDoc;

use App\FormDoc;
use App\Traits\Form\Value as ValueTrait;
use App\Traits\Form\Field as FieldTrait;
use App\FormDoc\Template\Field as TemplateField;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use ValueTrait,
        FieldTrait;

    protected $table = "form_doc_fields";

    protected $casts = [
        'separator' => 'boolean',
        'active' => 'boolean',
        'order' => 'integer',
        'options' => 'object',
    ];

    public function formDoc()
    {
        return $this->belongsTo(FormDoc::class, 'form_doc_id');
    }

    public function templateField()
    {
        return $this->belongsTo(TemplateField::class, 'form_doc_template_field_id');
    }

}
