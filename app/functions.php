<?php

namespace App;

function timezone_options() {
    return [
        'America/New_York'    => 'Eastern',
        'America/Chicago'     => 'Central',
        'America/Denver'      => 'Mountain',
        'America/Phoenix'     => 'Mountain (no DST)',
        'America/Los_Angeles' => 'Pacific',
        'America/Anchorage'   => 'Alaska',
        'America/Adak'        => 'Hawaii',
        'Pacific/Honolulu'    => 'Hawaii (no DST)',
    ];
}
