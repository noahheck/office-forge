<?php

namespace App\Report;

use App\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dataset extends Model
{
    use SoftDeletes;

    protected $table = 'report_datasets';

    protected $casts = [
        'order' => 'integer',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function datasetable()
    {
        return $this->morphTo();
    }
}
