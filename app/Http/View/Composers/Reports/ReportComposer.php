<?php

namespace App\Http\View\Composers\Reports;


use App\Report\Descriptor;
use Illuminate\View\View;

class ReportComposer
{
    private $descriptor;

    public function __construct(
        Descriptor $descriptor
    ) {
        $this->descriptor = $descriptor;
    }

    public function compose(View $view)
    {
        $view->with([
            'reportDescriptor' => $this->descriptor,
        ]);
    }
}
