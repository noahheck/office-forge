<?php


namespace App\Chart;


class Colors
{
    public static function getBackgroundColor()
    {
        return 'rgb(196, 196, 225)';
    }

    public static function blue($withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        return "rgb{$alpha}(103, 123, 156{$transparency})";
    }

    public static function green($withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        return "rgb{$alpha}(103, 156, 123{$transparency})";
    }

    public static function red($withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        return "rgb{$alpha}(156, 123, 103{$transparency})";
    }

    public static function brown($withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        return "rgb{$alpha}(156, 123, 103{$transparency})";
    }

    public static function purple($withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        return "rgb{$alpha}(123, 103, 156{$transparency})";
    }



    public static function getColors(int $numberOfColors, $withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        $colors = [
            "rgb{$alpha}(103, 123, 156{$transparency})",
            "rgb{$alpha}(103, 156, 123{$transparency})",

            "rgb{$alpha}(156, 103, 123{$transparency})",
            "rgb{$alpha}(156, 123, 103{$transparency})",

            "rgb{$alpha}(123, 103, 156{$transparency})",
            "rgb{$alpha}(123, 156, 103{$transparency})",
        ];

        while (count($colors) < $numberOfColors) {
            $colors[] = self::generateNewColor();
        }

        $colors = array_slice($colors, 0, $numberOfColors);

        return $colors;
    }

    public static function generateNewColor($withTransparency = false)
    {
        $alpha = ($withTransparency) ? 'a' : '';
        $transparency = ($withTransparency) ? ', 0.5' : '';

        $color1 = rand(50, 200);
        $color2 = rand(50, 200);
        $color3 = rand(50, 200);

        return "rgb{$alpha}({$color1}, {$color2}, {$color3}{$transparency})";
    }
}
