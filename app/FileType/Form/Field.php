<?php

namespace App\FileType\Form;

use App\FileType\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_form_fields';

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
        'panel_display' => 'boolean',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, 'file_type_form_id');
    }
}
