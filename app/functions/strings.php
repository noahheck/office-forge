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
            \App\format_date_string("1752-09-03"),//Doesn't exist - date Gregorian calendar adopted
            \App\format_date_string("2015-06-26"),//Obergefell v. Hodges
            \App\format_date_string("2002-09-23"),//Firefox released
            \App\format_date_string("1991-10-05"),//Linux released
            \App\format_date_string("2018-05-01"),//Honey's Household first commit
        ]);
    }

    return array_rand($dates);
}
