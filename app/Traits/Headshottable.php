<?php


namespace App\Traits;


use App\HeadShot;

trait Headshottable
{
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
}
