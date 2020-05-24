<?php

namespace App\icon;

// Generic
function go($classes = []) {
    $classes[] = "far fa-arrow-alt-circle-right";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function edit($classes = []) {
    $classes[] = "fas fa-edit";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function undo($classes = []) {
    $classes[] = "fas fa-undo";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function circlePlus($classes = []) {
    $classes[] = "fas fa-plus-circle";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function circleCheck($classes = []) {
    $classes[] = "fas fa-check-circle";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function check($classes = []) {
    $classes[] = "fas fa-check";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function uncheckedBox($classes = []) {
    $classes[] = "far fa-square";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function checkedBox($classes = []) {
    $classes[] = "far fa-check-square";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function text($classes = []) {
    $classes[] = "fas fa-align-left";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function calendar($classes = []) {
    $classes[] = "fas fa-calendar-alt";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function calendarDay($classes = []) {
    $classes[] = "fas fa-calendar-day";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function calendarWeek($classes = []) {
    $classes[] = "fas fa-calendar-week";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function calendarCheck($classes = []) {
    $classes[] = "far fa-calendar-check";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function verticalSort($classes = []) {
    $classes[] = "fas fa-arrows-alt-v";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function chevronDown($classes = []) {
    $classes[] = "fas fa-chevron-down";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function email($classes = []) {
    $classes[] = "fas fa-envelope";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function trash($classes = []) {
    $classes[] = "far fa-trash-alt";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function x($classes = []) {
    $classes[] = "fas fa-times";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}



// Main options
function home($classes = []) {
    $classes[] = "fas fa-home";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function files($classes = []) {
    $classes[] = "fas fa-folder-open";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function activities($classes = []) {
    $classes[] = "fas fa-project-diagram";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function processes($classes = []) {
    $classes[] = "fas fa-clipboard-list";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function mySettings($classes = []) {
    $classes[] = "fas fa-cog";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function adminSettings($classes = []) {
    $classes[] = "fas fa-cogs";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function logOut($classes = []) {
    $classes[] = "fas fa-sign-out-alt";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}



function teams($classes = []) {
    $classes[] = "fas fa-user-friends";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}





function myWork($classes = []) {
    $classes[] = "fas fa-briefcase";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}


// Files

function inMyFiles($classes = []) {
    $classes[] = "fas fa-star";

    return "<span class='" . implode(' ', $classes) . "' style='color: gold;'></span>";
}

function notInMyFiles($classes = []) {
    $classes[] = "far fa-star";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function fileDetails($classes = []) {
    $classes[] = "fas fa-th-list";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function forms($classes = []) {
    $classes[] = "far fa-list-alt";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function formDocs($classes = []) {
    $classes[] = "fas fa-file-invoice";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function formFields($classes = []) {
    $classes[] = "fas fa-pen-square";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}



// Activities
function tasks($classes = []) {
    $classes[] = "fas fa-tasks";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function isPrivate($classes = []) {
    $classes[] = "fas fa-user-shield";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function participants($classes = []) {
    $classes[] = "fas fa-user-friends";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}


// My Settings
function myDetails($classes = []) {
    $classes[] = "far fa-address-card";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function myPassword($classes = []) {
    $classes[] = "fas fa-user-shield";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function myPhoto($classes = []) {
    $classes[] = "fas fa-portrait";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}


// Admin Settings
function usersTeams($classes = []) {
    $classes[] = "fas fa-users-cog";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function users($classes = []) {
    $classes[] = "fas fa-users";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function user($classes = []) {
    $classes[] = "fas fa-user";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function userPlus($classes = []) {
    $classes[] = "fas fa-user-plus";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function userEdit($classes = []) {
    $classes[] = "fas fa-user-edit";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function userAdmin($classes = [], $title = '') {
    $classes[] = "fas fa-user-tie";

    $titleAttr = ($title) ? " title='" . \e($title) . "'" : '';

    return "<span class='" . implode(' ', $classes) . "'{$titleAttr}></span>";
}

function userSystemAdmin($classes = [], $title = '') {
    $classes[] = "fas fa-user-cog";

    $titleAttr = ($title) ? " title='" . \e($title) . "'" : '';

    return "<span class='" . implode(' ', $classes) . "'{$titleAttr}></span>";
}

function systemSetup($classes = []) {
    $classes[] = "fas fa-tools";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function organization($classes = []) {
    $classes[] = "fas fa-building";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function systemConfiguration($classes = []) {
    $classes[] = "fas fa-sliders-h";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function backups($classes = []) {
    $classes[] = "fas fa-download";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function server($classes = []) {
    $classes[] = "fas fa-server";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function updates($classes = []) {
    $classes[] = "fas fa-sync-alt";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function security($classes = []) {
    $classes[] = "fas fa-shield-alt";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}

function plugins($classes = []) {
    $classes[] = "fas fa-plug fa-rotate-90";

    return "<span class='" . implode(' ', $classes) . "'></span>";
}




function forActivity($activity, $classes = []) {
    if ($activity->process_id) {

        return processes($classes);
    }

    return activities($classes);
}
