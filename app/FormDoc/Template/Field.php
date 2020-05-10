<?php

namespace App\FormDoc\Template;

use App\FormDoc\Template;
use App\Traits\Form\Field as FieldTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes,
        FieldTrait;

    protected $table = "form_doc_template_fields";

    protected $casts = [
        'separator' => 'boolean',
        'active' => 'boolean',
        'order' => 'integer',
        'options' => 'object',
    ];

    public function formDocTemplate()
    {
        return $this->belongsTo(Template::class);
    }
}
