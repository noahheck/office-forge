<?php

namespace App;

use App\Utility\RandomColorGenerator;
use Illuminate\Support\Str;
//use function foo\func;

require_once __DIR__ . DIRECTORY_SEPARATOR . "functions/strings.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "functions/icons.php";

function flash_message($category, $message) {
    return \Session::push($category, $message);
}
function flash_success($message) {
    return flash_message('success', $message);
}
function flash_info($message) {
    return flash_message('info', $message);
}
function flash_warning($message) {
    return flash_message('warning', $message);
}
function flash_error($message) {
    return flash_message('error', $message);
}


function timezone_options() {
    return [
        'America/New_York'    => __('app.timezone_America/New_York'),
        'America/Chicago'     => __('app.timezone_America/Chicago'),
        'America/Denver'      => __('app.timezone_America/Denver'),
        'America/Phoenix'     => __('app.timezone_America/Phoenix'),
        'America/Los_Angeles' => __('app.timezone_America/Los_Angeles'),
        'America/Anchorage'   => __('app.timezone_America/Anchorage'),
        'America/Adak'        => __('app.timezone_America/Adak'),
        'Pacific/Honolulu'    => __('app.timezone_Pacific/Honolulu'),
    ];
}

function timezone_name($timezone) {
    return timezone_options()[$timezone] ?? '';
}

/**
 * Returns the correct timezone_options() $key from provided $value
 * e.g., $description = 'Mountain' return 'America/Denver'
 */
function timezone_from_description($description) {
    return array_flip(timezone_options())[$description] ?? '';
}

function format_date($date = null) {
    return ($date) ? $date->format('m/d/Y') : '';
}

function format_date_in_user_timezone($date = null) {
    if (!$date) {

        return '';
    }

    static $userTimezone = false;

    if (!$userTimezone) {
        $userTimezone = \Auth::user()->timezone;
    }

    return $date->copy()->tz($userTimezone)->format('m/d/Y');
}

function format_time($dateTime = null) {
    if (!$dateTime) {
        return '';
    }

    static $userTimezone = false;

    if (!$userTimezone) {
        $userTimezone = \Auth::user()->timezone;
    }

    return $dateTime->copy()->tz($userTimezone)->format('g:i a');
}

/**
 * Formats Datetime in user's timezone
 *
 * @param \Carbon\Carbon $datetime
 * @param string $format
 * @return mixed|string
 */
function format_datetime($datetime, $format = 'm/d/Y g:ia') {

    static $userTimezone = false;

    if (!$userTimezone) {
        $userTimezone = \Auth::user()->timezone;
    }

    return ($datetime) ? $datetime->copy()->tz($userTimezone)->format($format) : '';
}

function format_date_string($dateString) {

    return date('m/d/Y', strtotime($dateString));
}

function format_timeString($timeString) {

    return date('g:ia ', strtotime($timeString));
}

function format_timeStringForDatabase($timeString) {

    return date('H:i:00', strtotime($timeString));
}

// https://stackoverflow.com/a/2510459/2422852
function format_filesize($bytes) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, 1) . ' ' . $units[$pow];
}

function format_money($value) {

    return number_format($value, 2, '.', ',');
}

function format_decimal($value, $maxDecimalPlaces = 2) {

    $strLength = strlen($value);
    $decimalPosition = strpos($value, '.');

    if ($decimalPosition === false) {

        return $value;
    }

    // strlen starts at 1, strpos starts at 0, so we have to make up for the 0th character here
    if ($strLength - ($decimalPosition + 1) <= $maxDecimalPlaces) {

        return $value;
    }

    return number_format($value, $maxDecimalPlaces);
}

function format_float($value) {

    return floatval(str_replace(',', '', $value));
}


function temp_directory_path() {
    return \storage_path('app/temp');
}

function temp_id() {
    return Str::uuid();
}

function safe_text_editor_content($content) {
    $allowedTags = ['div', 'h2', 'h3', 'br', 'strong', 'em', 'u', 'a', 'blockquote', 'pre', 'ul', 'ol', 'li', 'img', 'figure', 'figcaption'];
    $tagsStripped = strip_tags($content, '<' . implode('><', $allowedTags) . '>');
    return $tagsStripped;
}



function filetype_field_options() {
    return [
        'text' => __('file.field_fieldTypeText'),
        'textarea' => __('file.field_fieldTypeTextarea'),
        'email' => __('file.field_fieldTypeEmail'),
        'date' => __('file.field_fieldTypeDate'),
        'name' => __('file.field_fieldTypeName'),
        'address' => __('file.field_fieldTypeAddress'),
        'phone' => __('file.field_fieldTypePhone'),
        'money' => __('file.field_fieldTypeMoney'),
        'integer' => __('file.field_fieldTypeInteger'),
        'range' => __('file.field_fieldTypeRange'),
        'decimal' => __('file.field_fieldTypeDecimal'),
        'checkbox' => __('file.field_fieldTypeCheckbox'),
        'select' => __('file.field_fieldTypeSelect'),
        'user' => __('file.field_fieldTypeUser'),
        'file' => __('file.field_fieldTypeFile'),
        'section-header' => __('file.field_fieldTypeSectionHeader'),
    ];
}




function dummyUser() {
    $user = new \App\User();

    $user->name = misc_name();
    $user->color = RandomColorGenerator::generateHex(RandomColorGenerator::COLOR_DARK);

    return $user;
}

function dummyFile($fileTypeId) {
    $file = new \App\File();

    $file->file_type_id = $fileTypeId;
    $file->name = misc_string();

    return $file;
}
