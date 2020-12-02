<?php

namespace App\FileType\Form;

use App\File\FormField\Value;
use App\FileType;
use App\FileType\Form;
use App\FileType\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Form\Field as FieldTrait;

class Field extends Model
{
    use SoftDeletes,
        FieldTrait;

    protected $table = 'file_type_form_fields';

    protected $casts = [
        'separator' => 'boolean',
        'active' => 'boolean',
        'order' => 'integer',
        'options' => 'object',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, 'file_type_form_id');
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'file_type_form_field_id');
    }

    public function panels()
    {
        return $this->belongsToMany(Panel::class, 'file_type_panels_fields', 'file_type_form_field_id', 'file_type_panel_id')->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }


    // This has to stay for the File fields to function correctly (there is no file_type_id column on the table)
    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

}
