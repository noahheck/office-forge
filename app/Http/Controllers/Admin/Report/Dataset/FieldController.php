<?php

namespace App\Http\Controllers\Admin\Report\Dataset;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\Datasets\Fields\Store as StoreRequest;
use App\Http\Requests\Admin\Reports\Datasets\Fields\Update as UpdateRequest;
use App\Jobs\Report\Dataset\Field\Create;
use App\Jobs\Report\Dataset\Field\Update;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Field;
use Illuminate\Http\Request;
use function App\flash_success;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report, Dataset $dataset)
    {
        $fields = $dataset->fields;

        return $this->view('admin.reports.datasets.fields.index', compact(
            'report',
            'dataset',
            'fields'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Report $report, Dataset $dataset)
    {
        $field = new Field;
        $field->dataset_id = $dataset->id;

        return $this->view('admin.reports.datasets.fields.create', compact(
            'report',
            'dataset',
            'field'
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
        $this->dispatchNow($fieldCreated = new Create(
            $dataset,
            $request->field_id,
            $request->label
        ));

        flash_success(__('admin.dataset_field_created'));

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report, Dataset $dataset, Field $field)
    {
        return $this->view('admin.reports.datasets.fields.show', compact(
            'report',
            'dataset',
            'field'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, Dataset $dataset, Field $field)
    {
        return $this->view('admin.reports.datasets.fields.edit', compact(
            'report',
            'dataset',
            'field'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Report $report, Dataset $dataset, Field $field)
    {
        $this->dispatchNow($fieldUpdated = new Update($field, $request->field_id, $request->label));

        flash_success(__('admin.dataset_field_updated'));

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report, Dataset $dataset, Field $field)
    {
        //
    }
}
