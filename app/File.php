<?php

namespace App;

use App\File\FormField\Value;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $casts = [
        'archived' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function formFieldValues()
    {
        return $this->hasMany(Value::class);
    }
}
