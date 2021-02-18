<?php


namespace App\Chart;



use Illuminate\Support\Str;

class GaugeChart implements \JsonSerializable
{
    private $title;

    private $description;

    private $height;

    private $width;

    private $value;

    private $max;

    private $id;

    public function __construct($title = '', $description = '', $height = 200, $width = 300, $value = 0, $max = 5)
    {
        $this->title = $title;
        $this->description = $description;
        $this->height = $height;
        $this->width = $width;

        $this->value = $value;

        $this->max = $max;

        $this->id = Str::camel($title) . '_' . Str::random(5);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setMax($max)
    {
        $this->max = $max;
    }

    public function getId()
    {
        return $this->id;
    }

    public function jsonSerialize()
    {
        $value = $this->value;
        $leftover = $this->max - $value;

        $colors = Colors::getColors(1);

        $color = $colors[0];
        $backgroundColor = Colors::getBackgroundColor();

        return [
            'type' => 'doughnut',
            'options' => [
                'title' => [
                    'display' => $this->title ? true : false,
                    'text' => $this->title,
                    'position' => 'top',
                ],
                'legend' => [
                    'display' => false,
                ],
                'rotation' => 3.14159,
                'circumference' => 3.14159,
                'tooltips' => [
                    'enabled' => false,
                ],
            ],
            'data' => [
                'datasets' => [[
                    'data' => [$value, $leftover],
                    'backgroundColor' => [$color, $backgroundColor],
                    'hoverBackgroundColor' => [$color, $backgroundColor],
                ]],
                'labels' => [],
            ]
        ];
    }

}
