<?php

namespace App\Http\Controllers\Admin\Report\Dataset;

use App\Http\Controllers\Controller;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Field;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Report $report, Dataset $dataset)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report, Dataset $dataset, Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, Dataset $dataset, Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report\Dataset\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report, Dataset $dataset, Field $field)
    {
        //
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
