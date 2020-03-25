<?php

namespace App\FileType;

use App\FileType;
use App\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panel extends Model
{
    use SoftDeletes;

    protected $table = 'file_type_panels';

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'file_type_panels_teams', 'file_type_panel_id', 'team_id')->withTimestamps();
    }
}
