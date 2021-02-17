<?php


namespace App\Chart;



use Illuminate\Support\Str;

class PieChart implements \JsonSerializable
{
    private $title;

    private $description;

    private $height;

    private $width;

    private $id;

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

    public function addDataToDataset($label, $value)
    {
        $this->datasets[$label] = $value;

        return $this;
    }

    public function jsonSerialize()
    {
        $datasets = $this->datasets;

        ksort($datasets);

        if (array_key_exists("", $datasets)) {
            $noKeyValue = $datasets[''];
            unset($datasets['']);
            $datasets = array_merge([__('app.noValue') => $noKeyValue], $datasets);
        }

        $colors = Colors::getColors(count($datasets));

        return [
            'type' => 'pie',
            'options' => [
                'title' => [
                    'display' => $this->title ? true : false,
                    'text' => $this->title,
                    'position' => 'top',
                ],
                'legend' => [
                    'display' => false,
                ],
            ],
            'data' => [
                'datasets' => [[
                    'data' => array_values($datasets),
                    'backgroundColor' => $colors,
                ]],
                'labels' => array_keys($datasets),
            ]
        ];
    }

}
