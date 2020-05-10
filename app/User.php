<?php

namespace App;

use App\Activity\Participant;
use App\Interfaces\Headshottable;
use App\Traits\Headshottable as HeadshottableTrait;
use App\Activity\Task;
use App\Traits\GetsInitialsFromName;
use App\Traits\User\ProvidesTodaysDate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements Headshottable
{
    use Notifiable,
        GetsInitialsFromName,
        ProvidesTodaysDate,
        HeadshottableTrait;

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

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }



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




    public function activities()
    {
        return $this->hasMany(Activity::class, 'owner_id')->orderBy('due_date');
    }

    public function openActivities()
    {
        return $this->activities()->where('completed', false)->orderBy('due_date');
    }

    public function createdActivities()
    {
        return $this->hasMany(Activity::class, 'created_by');
    }


    public function ownedActivities()
    {
        return $this->hasMany(Activity::class, 'owner_id')->orderBy('due_date');
    }

    public function openOwnedActivities()
    {
        return $this->ownedActivities()->where('completed', false)->orderBy('due_date');
    }

    public function participatingActivities()
    {
        return $this->hasManyThrough(Activity::class, Participant::class)->orderBy('due_date');
    }

    public function openParticipatingActivities()
    {
        return $this->participatingActivities()->where('completed', false)->orderBy('due_date');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }




    public function createdFormDocs()
    {
        return $this->hasMany(FormDoc::class, 'creator_id');
    }




    public function myFiles()
    {
        return $this->belongsToMany(File::class, "my_files")->withTimestamps()->orderBy('name');
    }

    public function inMyFiles(File $file)
    {
        return $this->myFiles->contains($file);
    }




    /**
     * @param bool $wrapped
     * @return string
     */
    public function iconAndName($withClasses = [], bool $wrapped = true): string
    {
        $output = $this->icon($withClasses) . ' ' . e($this->name);

        if ($wrapped) {
            $output = "<span class='user-icon-and-name' data-id='" . $this->id . "'>" . $output . "</span>";
        }

        return $output;
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
