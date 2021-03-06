<?php


namespace App\Navigation\LocationBar\Admin\Reports\Datasets\Fields;


use App\Navigation\LocationBar;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Field;

class Show extends LocationBar
{
    public function __construct(Report $report, Dataset $dataset, Field $field)
    {
        parent::__construct($field->label);

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Show($report, $dataset));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Fields($report, $dataset));

    }
}
