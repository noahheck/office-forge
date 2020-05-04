<?php

namespace App\FileType;

use App\FileType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormDoc extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_form_docs';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }
}
