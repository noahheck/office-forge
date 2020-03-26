<?php

namespace App\File\FormField;

use App\File;
use App\FileType\Form\Field;
use App\User;
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

    public function valueFile()
    {
        return $this->belongsTo(File::class, 'value_file');
    }

    public function valueUser()
    {
        return $this->belongsTo(User::class, 'value_user');
    }

    public function setValueDateAttribute($value)
    {
        $value_date = date('Y-m-d', strtotime($value));

        $this->attributes['value_date'] = $value_date;
    }

    public function getValueDateAttribute()
    {
        $value_date = $this->attributes['value_date'];

        return date('m/d/Y', strtotime($value_date));
    }

    public function valueName()
    {
        return $this->value_text1 . ' ' . $this->value_text2 . ' ' . $this->value_text3 . ' ' . $this->value_text4;
    }
}
