<?php

namespace App\Http\View\Composers\Reports;

use App\Report\Dataset\Filter\Descriptor;
use App\Report\ResultSet\Visualization\ResolverMapper;
use App\Report\ResultSet\Visualization\TemplateMapper;
use Illuminate\View\View;

class ResultSetComposer
{
    /**
     * @var Descriptor
     */
    private $filterDescriptor;

    /**
     * @var TemplateMapper
     */
    private $templateMapper;

    /**
     * @var ResolverMapper
     */
    private $resolverMapper;

    public function __construct(
        Descriptor $filterDescriptor,
        TemplateMapper $templateMapper,
        ResolverMapper $resolverMapper
    ) {
        $this->filterDescriptor = $filterDescriptor;
        $this->templateMapper = $templateMapper;
        $this->resolverMapper = $resolverMapper;
    }

    public function compose(View $view)
    {
        $view->with([
            'filterDescriptor' => $this->filterDescriptor,
            'templateMapper' => $this->templateMapper,
            'resolverMapper' => $this->resolverMapper,
        ]);
    }
}
