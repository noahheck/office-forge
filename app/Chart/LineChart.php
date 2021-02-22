<?php


namespace App\Chart;


use Illuminate\Support\Str;

class LineChart implements \JsonSerializable
{
    private $title;

    private $description;

    private $height;

    private $width;

    private $id;

    private $max = 0;

    private $labels;

    private $datasets;

    public function __construct($title = '', $description = '', $height = 200, $width = 300)
    {
        $this->title = $title;
        $this->description = $description;
        $this->height = $height;
        $this->width = $width;

        $this->id = Str::camel($title) . '_' . Str::random(5);

        $this->labels = [];
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

    /**
     * @param $labels - x-axis labels
     * @return $this
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function addDataset($datasetLabel, $dataset)
    {
        $this->datasets[$datasetLabel] = $dataset;

        return $this;
    }


    public function jsonSerialize()
    {
        $borderColors = Colors::getColors(2, false);
        $colors = Colors::getColors(2, true);

        $positions = ['left', 'right'];
        $gridLinesDisplay = [true, false];

        $datasets = [];
        $axes = [];

        $x = 0;
        foreach ($this->datasets as $key => $dataset) {

            if ($x > 1) {
                continue;
            }

            $datasets[] = [
                'label' => $key,
                'data' => $dataset,
                'fill' => false,
                'borderColor' => $colors[$x],
                'pointBorderColor' => $borderColors[$x],
                'pointBackgroundColor' => $borderColors[$x],
                'yAxisID' => 'axis_' . $x,
            ];

            $axes[] = [
                'id' => 'axis_' . $x,
                'type' => 'linear',
                'position' => $positions[$x],
                'gridLines' => [
                    'display' => $gridLinesDisplay[$x],
                ],
                'ticks' => [
                    'beginAtZero' => true,
                ],
                'scaleLabel' => [
                    'display' => true,
                    'labelString' => $key,
                ],
            ];

            $x++;
        }

        return [
            'type' => 'line',
            'options' => [
                'title' => [
                    'display' => $this->title ? true : false,
                    'text' => $this->title,
                    'position' => 'top',
                ],
                'legend' => [
                    'display' => false,
                ],
                'scales' => [
                    'yAxes' => $axes,
                ],
            ],
            'data' => [
                'datasets' => $datasets,
                'labels' => $this->labels,
            ]
        ];
    }
}
