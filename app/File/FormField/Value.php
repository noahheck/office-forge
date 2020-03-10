<?php

namespace App\File\FormField;

use App\File;
use App\FileType\Form\Field;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'file_type_form_field_id');
    }
}
