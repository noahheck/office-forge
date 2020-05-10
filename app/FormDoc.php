<?php

namespace App;

use App\FormDoc\Field;
use App\FormDoc\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormDoc extends Model
{
    use SoftDeletes;

    protected $dates = [
        'published_at',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class, 'form_doc_template_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'form_doc_id');
    }

    public function isPublished()
    {
        return !is_null($this->published_at);
    }
}
