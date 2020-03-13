<?php

namespace App\File\FormField;

use App\File;
use App\FileType\Form\Field;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'file_formfield_values';

    protected $casts = [
        'value_date' => 'date|Y-m-d',
    ];

//    protected $dateFormat = "Y-m-d";

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'file_type_form_field_id');
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
}
