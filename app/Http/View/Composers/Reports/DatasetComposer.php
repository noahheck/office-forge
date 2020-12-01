<?php

namespace App\Http\View\Composers\Reports;

use App\Report\Dataset\Filter\Descriptor;
use App\Report\Dataset\Renderer;
use Illuminate\View\View;

class DatasetComposer
{
    /**
     * @var Descriptor
     */
    private $filterDescriptor;

    /**
     * @var Renderer
     */
    private $datasetRenderer;

    public function __construct(Descriptor $filterDescriptor/*, Renderer $datasetRenderer*/)
    {
        $this->filterDescriptor = $filterDescriptor;
//        $this->datasetRenderer = $datasetRenderer;
    }

    public function compose(View $view)
    {


        $view->with([
            'filterDescriptor' => $this->filterDescriptor,
//            'datasetRenderer' => $this->datasetRenderer,
        ]);
    }
}
