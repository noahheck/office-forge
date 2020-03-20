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
        'separator' => 'boolean',
        'active' => 'boolean',
        'order' => 'integer',
        'options' => 'object',
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

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    public function selectOptions()
    {
        $select_options = optional($this->options)->select_options ?? [];

        return array_combine($select_options, $select_options);
    }

    public function icon(array $withClasses = [])
    {
        $function = "\App\icon\\filetype_field_" . $this->field_type;

        if (!function_exists($function)) {

            return "";
        }

        return $function($withClasses);
    }

}
