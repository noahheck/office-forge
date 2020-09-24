<?php


namespace App\Traits\Commands;


trait HasScheduledHourlyTime
{
    private function shouldRunThisHour($scheduleTime)
    {
        $timeToRun = substr($scheduleTime, 0, 2);

        $thisHour = now()->format('H');

        return (string) $timeToRun === (string) $thisHour;
    }
}
