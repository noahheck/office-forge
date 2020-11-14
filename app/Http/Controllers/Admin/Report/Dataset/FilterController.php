<?php

namespace App\Http\Controllers\Admin\Report\Dataset;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\Datasets\Filters\Store as StoreRequest;
use App\Jobs\Report\Dataset\Filter\Create;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Filter;
use Illuminate\Http\Request;
use function App\flash_success;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report, Dataset $dataset)
    {
        $filters = $dataset->filters;

        return $this->view('admin.reports.datasets.filters.index', compact(
            'report',
            'dataset',
            'filters'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Report $report, Dataset $dataset)
    {
        $filter = new Filter;
        $filter->dataset_id = $dataset->id;

        return $this->view('admin.reports.datasets.filters.create', compact(
            'report',
            'dataset',
            'filter'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Report $report, Dataset $dataset)
    {
        $this->dispatchNow($filterCreated = new Create(
            $dataset,
            $request->field_id,
            $request->operator
        ));

        $filter = $filterCreated->getFilter();

        flash_success(__('admin.filter_created'));

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report\Dataset\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report, Dataset $dataset, Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report\Dataset\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, Dataset $dataset, Filter $filter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report\Dataset\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report, Dataset $dataset, Filter $filter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report\Dataset\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report, Dataset $dataset, Filter $filter)
    {
        //
    }
}
