<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Report;
use App\Report\Dataset;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function create(Report $report)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Report $report)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @param  \App\Report\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report, Dataset $dataset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @param  \App\Report\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, Dataset $dataset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @param  \App\Report\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report, Dataset $dataset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @param  \App\Report\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report, Dataset $dataset)
    {
        //
    }
}
