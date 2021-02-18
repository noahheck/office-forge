<?php


namespace App\Chart;


class Colors
{
    public static function getBackgroundColor()
    {
        return 'rgb(196, 196, 225)';
    }

    public static function getColors(int $numberOfColors)
    {
        $colors = [
            'rgb(103, 123, 156)',
            'rgb(103, 156, 123)',

            'rgb(156, 103, 123)',
            'rgb(156, 123, 103)',

            'rgb(123, 103, 156)',
            'rgb(123, 156, 103)',
        ];

        while (count($colors) < $numberOfColors) {
            $colors[] = self::generateNewColor();
        }

        $colors = array_slice($colors, 0, $numberOfColors);

        return $colors;
    }

    public static function generateNewColor()
    {
        $color1 = rand(50, 200);
        $color2 = rand(50, 200);
        $color3 = rand(50, 200);

        return "rgb({$color1}, {$color2}, {$color3})";
    }
}
