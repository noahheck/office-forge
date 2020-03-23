<?php

namespace App\FileType\Form;

use App\File\FormField\Value;
use App\FileType;
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

    public function fieldName()
    {
        return 'field_' . $this->id;
    }

    public function selectOptions()
    {
        $select_options = optional($this->options)->select_options ?? [];

        return array_combine($select_options, $select_options);
    }

    public function decimalPlaces()
    {
        return optional($this->options)->decimal_places;
    }

    public function userTeam()
    {
        return optional($this->options)->user_team;
    }

    public function fileTypeId()
    {
        return optional($this->options)->file_type;
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function getFileTypeIdAttribute()
    {
        return $this->fileTypeId();
    }




}
