<?php

namespace App;

use Illuminate\Support\Str;

require_once __DIR__ . DIRECTORY_SEPARATOR . "functions/icons.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "functions/form.php";

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

function format_date($date = null) {
    return ($date) ? $date->format('m/d/Y') : '';
}

function format_datetime($datetime) {

    static $userTimezone = false;

    if (!$userTimezone) {
        $userTimezone = \Auth::user()->timezone;
    }

    return ($datetime) ? $datetime->copy()->tz($userTimezone)->format('m/d/Y g:ia') : '';
}

function temp_id() {
    return Str::uuid();
}

function safe_text_editor_content($content) {
    $allowedTags = ['div', 'h2', 'h3', 'br', 'strong', 'em', 'u', 'blockquote', 'pre', 'ul', 'ol', 'li', 'img', 'figure', 'figcaption'];
    $tagsStripped = strip_tags($content, '<' . implode('><', $allowedTags) . '>');
    return $tagsStripped;
}



function filetype_field_options() {
    return [
        'text' => __('file.field_fieldTypeText'),
        'textarea' => __('file.field_fieldTypeTextarea'),
        'email' => __('file.field_fieldTypeEmail'),
        'date' => __('file.field_fieldTypeDate'),
    ];
}
