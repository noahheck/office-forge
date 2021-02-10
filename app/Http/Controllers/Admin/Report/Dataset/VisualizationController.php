<?php

namespace App\Http\Controllers\Admin\Report\Dataset;

use App\Http\Controllers\Controller;
use App\Jobs\Report\Dataset\Visualization\Create;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Visualization;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Reports\Datasets\Visualizations\Store as StoreRequest;
use function App\flash_success;

class VisualizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report, Dataset $dataset)
    {
        $visualizations = $dataset->visualizations;

        return $this->view('admin.reports.datasets.visualizations.index', compact(
            'report',
            'dataset',
            'visualizations'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Report $report, Dataset $dataset)
    {
        $visualization = new Visualization;
        $visualization->dataset_id = $dataset->id;

        return $this->view('admin.reports.datasets.visualizations.create', compact(
            'report',
            'dataset',
            'visualization'
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
        $this->dispatchNow($visualizationCreated = new Create(
            $dataset,
            $request->label,
            $request->type
        ));

        flash_success(__('admin.dataset_visualization_created'));

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report, Dataset $dataset, Visualization $visualization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, Dataset $dataset, Visualization $visualization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report, Dataset $dataset, Visualization $visualization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report, Dataset $dataset, Visualization $visualization)
    {
        //
    }
}
