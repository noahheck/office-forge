<?php

namespace App\File\FormField;

use App\File;
use App\FileType\Form\Field;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'file_formfield_values';

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'file_type_form_field_id');
    }
}
