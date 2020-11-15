<?php

namespace App\File\FormField;

use App\File;
use App\FileType\Form\Field;
use App\Traits\Form\Value as ValueTrait;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use ValueTrait;

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
