<?php

namespace App;

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

function format_date($date = null)
{
    return ($date) ? $date->format('m/d/Y') : '';
}

function temp_id() {
    return \Str::uuid();
}

function safe_text_editor_content($content) {
    $allowedTags = ['div', 'h2', 'h3', 'br', 'strong', 'em', 'u', 'blockquote', 'pre', 'ul', 'ol', 'li', 'img', 'figure', 'figcaption'];
    $tagsStripped = strip_tags($content, '<' . implode('><', $allowedTags) . '>');
    return $tagsStripped;
}
