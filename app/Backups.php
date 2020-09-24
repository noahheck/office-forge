<?php


namespace App;


class Backups
{
    const TIME_OPTION = 'backups.time';
    const TIME_OPTION_DEFAULT = '00:00';

    const STORAGE_TIME_OPTION = 'backups.storage-time';
    const STORAGE_TIME_OPTION_DEFAULT = 30;

    public static function storageTimeOptions()
    {
        return [
            '7' => __('admin.backups_storageTime_week'),
            '30' => __('admin.backups_storageTime_one-month'),
            '60' => __('admin.backups_storageTime_two-months'),
            '90' => __('admin.backups_storageTime_three-months'),
            '180' => __('admin.backups_storageTime_six-months'),
            '365' => __('admin.backups_storageTime_one-year'),
            '0' => __('admin.backups_storageTime_indefinitely'),
        ];
    }

    public static function timeOptions()
    {
        return array_map(function($hour) {
            return str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
        }, range(0, 23));
    }
}
