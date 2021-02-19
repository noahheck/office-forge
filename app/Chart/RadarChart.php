<?php


namespace App\Chart;



use Illuminate\Support\Str;

class RadarChart implements \JsonSerializable
{
    private $title;

    private $description;

    private $height;

    private $width;

    private $id;

    private $max = 0;

    private $datasets;

    public function __construct($title = '', $description = '', $height = 200, $width = 300)
    {
        $this->title = $title;
        $this->description = $description;
        $this->height = $height;
        $this->width = $width;

        $this->id = Str::camel($title) . '_' . Str::random(5);

        $this->datasets = [];
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

    public function getId()
    {
        return $this->id;
    }

    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    public function addDataToDataset($label, $value)
    {
        $this->datasets[$label] = $value;

        return $this;
    }

    public function jsonSerialize()
    {
        $datasets = $this->datasets;

        $borderColor = Colors::getColors(1, false);
        $color = Colors::getColors(1, true);

        return [
            'type' => 'radar',
            'options' => [
                'title' => [
                    'display' => $this->title ? true : false,
                    'text' => $this->title,
                    'position' => 'top',
                ],
                'legend' => [
                    'display' => false,
                ],
                'scale' => [
                    'ticks' => [
                        'beginAtZero' => true,
                        'suggestedMax' => (int) $this->max,
                    ],
                ],
            ],
            'data' => [
                'datasets' => [[
                    'data' => array_values($datasets),
                    'borderColor' => $borderColor,
                    'backgroundColor' => $color,
                    'borderWidth' => '1',
                ]],
                'labels' => array_keys($datasets),
            ]
        ];
    }

}
