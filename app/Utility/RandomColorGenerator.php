<?php

namespace App\Utility;

class RandomColorGenerator
{
    const COLOR_ALL = 'all';
    const COLOR_DARK = 'dark';
    const COLOR_LIGHT = 'light';

    static public function generateHex($colorSubSet = self::COLOR_ALL): string
    {
        $minVal = ($colorSubSet === self::COLOR_LIGHT) ? 120 : 16;
        $maxVal = ($colorSubSet === self::COLOR_DARK) ? 160 : 240;
        $color = '#' . self::random_color_part($minVal, $maxVal)
            . self::random_color_part($minVal, $maxVal)
            . self::random_color_part($minVal, $maxVal);
        return $color;
    }

    /**
     * https://stackoverflow.com/a/5614583/2422852
     */
    static private function random_color_part($min, $max): string
    {
        return str_pad(dechex(mt_rand($min, $max)), 2, '0', \STR_PAD_LEFT);
    }
}
