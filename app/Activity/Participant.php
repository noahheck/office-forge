<?php

namespace App\Activity;

use App\Activity;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'activity_participants';

    protected $dates = [
        'removed_at',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
