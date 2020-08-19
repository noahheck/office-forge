<?php

namespace App\Server\Updates;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    protected $table = 'server_updates';

    protected $casts = [
        'successful' => 'boolean',
    ];
}
