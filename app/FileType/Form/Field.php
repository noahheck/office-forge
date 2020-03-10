<?php

namespace App\FileType\Form;

use App\File\FormField\Value;
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

    public function values()
    {
        return $this->hasMany(Value::class, 'file_type_form_field_id');
    }

    public function icon(array $withClasses = [])
    {
        $function = "\App\icon\\filetype_field_" . $this->field_type;

        if (!function_exists($function)) {

            return "";
        }

        return $function($withClasses);
    }

    public function preview(array $withClasses = [])
    {
        $function = "\App\icon\\filetype_field_preview_" . $this->field_type;

        if (!function_exists($function)) {

            return "help";
        }

        return $function($withClasses);
    }
}
