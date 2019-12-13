<?php

namespace App;

use App\Interfaces\Headshottable;
use App\Traits\GetsInitialsFromName;
use App\Traits\User\ProvidesTodaysDate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements Headshottable
{
    use Notifiable,
        GetsInitialsFromName,
        ProvidesTodaysDate;

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




    public function ownedProjects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    public function createdProjects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }




    // Probably extracting this to the HasHeadShots trait
    public function headshots()
    {
        return $this->morphMany(HeadShot::class, 'headshottable');
    }

    public function currentHeadshot()
    {
        return $this->headshots->firstWhere('current', true);
    }

    public function hasHeadshot(): bool
    {
        return !is_null($this->currentHeadshot());
    }

    /**
     * Differs from $this->icon() in that this will always return an img tag; src will be user icon photo instead of
     * text-style colored icon if there is no headshot for this user
     *
     * @param array $withClasses
     * @return string
     */
    public function iconPhoto($withClasses = []): string
    {
        $source = "/images/user.icon.png";
        $classes = implode(' ', array_unique(array_merge($withClasses, ['icon', 'rounded-circle'])));

        if ($headshot = $this->currentHeadshot()) {
            $source = route('headshot', [$headshot->id, 'thumb', $headshot->thumb_filename]);
            $classes .= ' headshot';
        }


        return "<img class='" . $classes . "' src='" . $source . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
    }

    public function icon($withClasses = []): string
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['headshot', 'icon', 'rounded-circle'])));

            return "<img class='" . e($classes) . "' src='" . route('headshot', [$headshot->id, 'icon', $headshot->icon_filename]) . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
        }

        return "<span class='user-icon' style='background-color: {$this->color};' title='" . e($this->name) . "'>{$this->initials}</span>";
    }

    public function thumbnail($withClasses = []): string
    {
        $source = "/images/user.thumb.png";
        $classes = implode(' ', array_unique(array_merge($withClasses, ['thumbnail'])));

        if ($headshot = $this->currentHeadshot()) {
            $source = route('headshot', [$headshot->id, 'thumb', $headshot->thumb_filename]);
            $classes .= ' headshot';
        }


        return "<img class='" . $classes . "' src='" . $source . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
    }

    public function photo($withClasses = []): string
    {
        $source = "/images/user.png";
        $classes = implode(' ', array_unique(array_merge($withClasses, ['photo'])));

        if ($headshot = $this->currentHeadshot()) {
            $source = route('headshot', [$headshot->id, 'base', $headshot->filename]);
            $classes .= ' headshot';
        }


        return "<img class='" . $classes . "' src='" . $source . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
    }


}
