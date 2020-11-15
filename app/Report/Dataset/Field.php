<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'report_dataset_fields';

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id');
    }

    public function field()
    {
        return $this->morphTo();
    }

    public function templateField()
    {
        return $this->morphTo('template_field', null, 'field_id');
    }
}
