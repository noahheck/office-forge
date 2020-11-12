<?php

namespace App;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $casts = [
        'active' => 'boolean',
    ];

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'reports_teams', 'report_id', 'team_id')->withTimestamps();
    }

    public function datasets()
    {
        return $this->hasMany(Dataset::class, 'report_id');
    }
}
