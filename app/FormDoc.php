<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormDoc extends Model
{
    use SoftDeletes;

    protected $table = 'form_docs';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }
}
