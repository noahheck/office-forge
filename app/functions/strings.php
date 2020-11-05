<?php

namespace App;

function misc_string() {

    static $strings = false;

    if (!$strings) {
        $strings = array_flip([
            __('misc.phil_marcusAurelius'),
            __('misc.phil_epictetus'),
            __('misc.phil_seneca'),
            __('misc.phil_plato'),
            __('misc.phil_catoTheYounger'),
            __('misc.phil_welcomeEvents'),
            __('misc.compsci_algorithm'),
            __('misc.compsci_logger'),
            __('misc.compsci_designPattern'),
            __('misc.compsci_dependencyInjection'),
            __('misc.compsci_autoIncrement'),

        ]);
    }

    return array_rand($strings);
}


function misc_longtext() {
    static $strings = false;

    if (!$strings) {
        $strings = array_flip([
            __('misc.phil_welcomeEventsFull'),
            __('misc.phil_staytheCourse'),
            __('misc.longtext_leather'),
            __('misc.longtext_reconsider'),
        ]);
    }

    return array_rand($strings);
}


function misc_name() {
    static $strings = false;

    if (!$strings) {
        $strings = array_flip([
            __('misc.phil_marcusAurelius'),
            __('misc.phil_epictetus'),
            __('misc.phil_seneca'),
            __('misc.phil_plato'),
            __('misc.phil_catoTheYounger'),
            __('misc.name_graceHopper'),
            __('misc.name_adaLovelace'),
            __('misc.name_idaRhodes'),
            __('misc.name_sophieWilson'),
            __('misc.name_aminataSanaCongo'),
            __('misc.name_maryLouJepsen'),
            __('misc.name_alanTuring'),
            __('misc.name_edgarAllanPoe'),
            __('misc.name_georgeWashington'),
            __('misc.name_georgeWashingtonCarver'),
            __('misc.name_isaacNewton'),
            __('misc.name_tonyStark'),

        ]);
    }

    return array_rand($strings);
}


function misc_date() {
    static $dates = false;

    if (!$dates) {
        $dates = array_flip([
            \App\format_date_string("1752-09-03"),// Doesn't exist - date Gregorian calendar adopted
            \App\format_date_string("2015-06-26"),// Obergefell v. Hodges
            \App\format_date_string("2002-09-23"),// Firefox released
            \App\format_date_string("1991-10-05"),// Linux released
            \App\format_date_string("2018-05-01"),// Honey's Household first commit
        ]);
    }

    return array_rand($dates);
}


function misc_phone() {
    static $phones = false;

    if (!$phones) {
        $phones = array_flip([
            '(800) 273-8255',// National Suicide Prevention Lifeline
            '(703) 836-4412',// Prevent Cancer Foundation
            '(212) 679-7016',// Doctors Without Borders
            '(605) 475-6968',// Rejection Hotline
        ]);
    }

    return array_rand($phones);
}

function misc_email() {
    static $emails = false;

    if (!$emails) {
        $emails = array_flip([
            'john.doe@example.com',// John Doe, apparently
            'loismustdie@yahoo.com',//Stewie Griffin
            'ChunkyLover53@aol.com',// Homer Simpson

        ]);
    }

    return array_rand($emails);
}

function misc_integer($min = 0, $max = 42) {
    static $integers = false;

    if (!$integers) {
        $integers = array_flip([
            '42',// Answer to the Ultimate Question of Life, the Universe, and Everything
            '3',// Three
            '9',// Three multiplied by three
            '25',// Number of prime numbers between 1 and 100
            '0',// Zero
        ]);
    }

    $val = array_rand($integers);

    if ($val < $min || $val > $max) {
        $val = array_rand([$min, $max]);
    }

    return $val;
}

function misc_decimal($decimalPlaces = 2) {
    static $decimals = false;

    if (!$decimals) {
        $decimals = array_flip([
            '' . M_PI,// Pi
            '' . M_SQRTPI,// Square root of Pi
            '' . M_E,// E
            '' . M_EULER,// Euler constant
        ]);
    }

    $dec = array_rand($decimals);

    return number_format($dec, $decimalPlaces, '.', ',');
}

function misc_money() {
    static $money = false;

    if (!$money) {
        $money = array_flip([
            '0.00',// Amount spent on cigarettes in the last 7 years
            '50.00',// My pocket money each month right now
            '329.13',// Pickup payment
            '1200.00',// Coronavirus stimulus payment for adult
            '14.95',// Cost of the closest book to me right now (Memoirs of a Geisha)
        ]);
    }

    $moneyItem = array_rand($money);

    return number_format($moneyItem, 2, '.', ',');
}

function misc_address() {
    static $addresses = false;

    if (!$addresses) {
        $addresses = [
            ['1600 Pennsylvania Avenue', 'Washington DC'],// White House
            ['11 Wall Street', 'New York, NY 10005'],// Wall Street
            ['901 7th Street NW', 'Washington, DC 20001-3719'],// Smithsonian
            ['300 Alamo Plaza', 'San Antonio, TX 78205'],// The Alamo
            ['400 Broad St.', 'Seattle, WA 98109'],// Space Needle
            ['121 Baker St.', 'Atlanta, GA 30313'],// World of Coca-Cola
        ];
    }

    return \Arr::random($addresses);
}
