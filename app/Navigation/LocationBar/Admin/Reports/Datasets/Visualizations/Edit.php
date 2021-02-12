<?php


namespace App\Navigation\LocationBar\Admin\Reports\Datasets\Visualizations;


use App\Navigation\LocationBar;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Visualization;

class Edit extends LocationBar
{
    public function __construct(Report $report, Dataset $dataset, Visualization $visualization)
    {
        parent::__construct(__('app.edit'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Reports);
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Show($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets($report));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Show($report, $dataset));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Visualizations($report, $dataset));
        $this->addLink(new \App\Navigation\Link\Admin\Reports\Datasets\Visualizations\Show($report, $dataset, $visualization));

    }
}
