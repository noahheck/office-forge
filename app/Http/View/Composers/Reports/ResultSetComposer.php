<?php

namespace App\Http\View\Composers\Reports;

use App\Report\Dataset\Filter\Descriptor;
use App\Report\Dataset\Renderer;
use Illuminate\View\View;

class ResultSetComposer
{
    /**
     * @var Descriptor
     */
    private $filterDescriptor;

    public function __construct(Descriptor $filterDescriptor)
    {
        $this->filterDescriptor = $filterDescriptor;
    }

    public function compose(View $view)
    {
        $view->with([
            'filterDescriptor' => $this->filterDescriptor,
        ]);
    }
}
