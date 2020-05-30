<?php


namespace App\Traits\User;


use Carbon\Carbon;

trait ProvidesTodaysDate
{
    public function today()
    {
        return Carbon::now(new \DateTimeZone($this->timezone));
    }

    public function timeAgo($timeFrame)
    {
        $method = 'sub' . ucfirst($timeFrame);

        return $this->today()->$method()->set('hour', '00')->set('minute', '00')->set('second', '00');
    }
}
