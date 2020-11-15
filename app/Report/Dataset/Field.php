<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'report_dataset_fields';

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id')->withPivot('label', 'order');
    }

    public function field()
    {
        return $this->morphTo();
    }
}
