<?php

namespace App;

use App\Interfaces\Headshottable;
use App\Traits\GetsInitialsFromName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements Headshottable
{
    use Notifiable,
        GetsInitialsFromName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'job_title', 'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'    => 'datetime',
        'active'               => 'boolean',
        'administrator'        => 'boolean',
        'system_administrator' => 'boolean',
    ];



    public function isAdministrator()
    {
        return $this->administrator;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

    public function isMemberOf(Team $team)
    {
        return $team->members->contains($this);
    }






    // Probably extracting this to the HasHeadShots trait
    public function headshots()
    {
        return $this->morphMany(HeadShot::class, 'headshottable');
    }

    public function icon()
    {
        return "<span class='user-icon' style='background-color: {$this->color};' title='" . e($this->name) . "'>{$this->initials}</span>";
    }
}
