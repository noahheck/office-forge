<?php

namespace App\FileStore;

use App\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drive extends Model
{
    use SoftDeletes;

    protected $table = 'filestore_drives';

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'filestore_drives_teams');
    }
}
