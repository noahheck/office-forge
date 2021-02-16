<?php

namespace App\Http\Controllers\Admin\Report\Dataset;

use App\Http\Controllers\Controller;
use App\Jobs\Report\Dataset\Visualization\Create;
use App\Jobs\Report\Dataset\Visualization\Update;
use App\Jobs\Report\Dataset\Visualization\UpdateOrder;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Visualization;
use App\Report\Dataset\Visualization\Validator;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Reports\Datasets\Visualizations\Store as StoreRequest;
use App\Http\Requests\Admin\Reports\Datasets\Visualizations\Update as UpdateRequest;
use function App\flash_info;
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
    public function store(StoreRequest $request, Report $report, Dataset $dataset, Validator $validator)
    {
        $validRequest = $validator->getValidValuesForVisualizationForDataset($dataset, $request);

        if (!$validRequest['success']) {

            return redirect()->back(302)->withInput();
        }

        $type = $validRequest['type'];
        $field_id = $validRequest['field_id'];

        $this->dispatchNow($visualizationCreated = new Create(
            $dataset,
            $request->label,
            $type,
            $field_id
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
        return $this->view('admin.reports.datasets.visualizations.show', compact(
            'report',
            'dataset',
            'visualization'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, Dataset $dataset, Visualization $visualization)
    {
        return $this->view('admin.reports.datasets.visualizations.edit', compact(
            'report',
            'dataset',
            'visualization'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateRequest $request,
        Report $report,
        Dataset $dataset,
        Visualization $visualization,
        Validator $validator
    ) {

        $validRequest = $validator->getValidValuesForVisualizationForDataset($dataset, $request);

        if (!$validRequest['success']) {

            return redirect()->back(302)->withInput();
        }

        $type = $validRequest['type'];
        $field_id = $validRequest['field_id'];

        $this->dispatchNow($visualizationUpdated = new Update(
            $visualization,
            $request->label,
            $type,
            $field_id
        ));

        flash_success(__('admin.dataset_visualization_updated'));

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report\Dataset\Visualization  $visualization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report, Dataset $dataset, Visualization $visualization)
    {
        $visualization->delete();

        flash_info(__('admin.dataset_visualization_deleted'));

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
    }


    public function updateOrder(Request $request, Report $report, Dataset $dataset)
    {
        $this->dispatchNow($visualizationsOrdered = new UpdateOrder($dataset, $request->orderedVisualizations));

        return $this->json(true, [
            'successMessage' => __('admin.dataset_visualizations_ordered'),
        ]);
    }
}
