<?php

namespace App\Report;

use App\Report;
use App\Report\Dataset\Field;
use App\Report\Dataset\Filter;
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

    public function filters()
    {
        return $this->hasMany(Filter::class, 'dataset_id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'dataset_id')->orderBy('order');
    }
}
