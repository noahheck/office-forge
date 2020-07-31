<?php


namespace App;


class Options
{
    public function get($optionName, $default = null)
    {
        return \Option::get($optionName, $default);
    }

    public function set($optionName, $value = null)
    {
        \Option::set($optionName, $value);

        return true;
    }
}
