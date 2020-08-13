<?php

namespace App;

use App\File\FormField\Value;
use App\FileType\AccessLock;
use App\Interfaces\Headshottable;
use App\Traits\Headshottable as HeadshottableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model implements Headshottable
{
    use SoftDeletes,
        HeadshottableTrait;

    protected $casts = [
        'archived' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public function teams()
    {
        return $this->fileType->teams();
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function formFieldValues()
    {
        return $this->hasMany(Value::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->orderBy('due_date');
    }

    public function formDocs()
    {
        return $this->hasMany(FormDoc::class, 'file_id');
    }

    public function accessLocks()
    {
        return $this->belongsToMany(AccessLock::class, 'file_access_locks')->orderBy('name')->withTimestamps();
    }




    public function icon(array $withClasses = [])
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['headshot', 'file-icon', 'icon', 'rounded'])));

            $title = e($this->fileType->name) . ' - ' . e($this->name);

            return "<img class='" . e($classes) . "' src='" . route('headshot', [$headshot->id, 'icon', $headshot->icon_filename]) . "' title='" . $title . "' alt='" . $title . "'>";
        }

        return $this->fileType->icon($withClasses);
    }

    public function thumbnail($withClasses = []): string
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['thumbnail'])));
            $source = route('headshot', [$headshot->id, 'thumb', $headshot->thumb_filename]);
            $classes .= ' headshot rounded';
            return "<img class='" . $classes . "' src='" . $source . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
        }

        $withClasses[] = "file-thumbnail";
        $withClasses[] = "file-icon";

        return $this->fileType->icon($withClasses);
    }

}
