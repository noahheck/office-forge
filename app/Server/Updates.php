<?php


namespace App\Server;


class Updates
{
    const SCHEDULE_OPTION = 'server.updates.schedule';
    const TIME_OPTION = 'server.updates.time';

    const SCHEDULE_DAILY = 'daily';
    const SCHEDULE_WEEKLY = 'weekly';
    const SCHEDULE_MONTHLY = 'monthly';
    const SCHEDULE_DISABLED = 'disabled';

    public static function scheduleOptions()
    {
        return [
            self::SCHEDULE_DAILY => __('admin.server_updateSchedule_daily'),
            self::SCHEDULE_WEEKLY => __('admin.server_updateSchedule_weeklyOnMonday'),
            self::SCHEDULE_MONTHLY => __('admin.server_updateSchedule_monthlyOnFirstMonday'),
            self::SCHEDULE_DISABLED => __('admin.server_updateSchedule_disabled'),
        ];
    }

    public static function timeOptions()
    {
        $utcTimes = array_map(function($hour) {
            return str_pad($hour, 2, '0', STR_PAD_LEFT) . ':20';
        }, range(0, 23));

        $timeOptions =  array_flip($utcTimes);

        $now = now();

        array_walk($timeOptions, function(&$value, $utcTime) use($now) {
            $time = $now->setTimeFromTimeString($utcTime);

            $value = \App\format_time($time);
        });

        return $timeOptions;
    }
}
