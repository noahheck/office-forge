<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\Store as StoreRequest;
use App\Http\Requests\Admin\Reports\Update as UpdateRequest;
use App\Jobs\Report\Create;
use App\Jobs\Report\Update;
use App\Report;
use App\Team;
use Illuminate\Http\Request;
use function App\flash_success;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report)
    {
        $reports = $report->orderBy('name')->get();

        \Debugbar::info($reports);

        return $this->view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $report = new Report;

        $report->active = true;

        $teamOptions = Team::orderBy('name')->get();

        return $this->view('admin.reports.create', compact('report', 'teamOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($reportCreated = new Create(
            $request->name,
            $request->description,
            $request->has('active'),
            $request->teams
        ));

        flash_success(__('admin.report_created'));

        $report = $reportCreated->getReport();

        return redirect()->route('admin.reports.show', [$report]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return $this->view('admin.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $teamOptions = Team::orderBy('name')->get();

        return $this->view('admin.reports.edit', compact('report', 'teamOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Report $report)
    {
        $this->dispatchNow($reportUpdated = new Update(
            $report,
            $request->name,
            $request->description,
            $request->has('active'),
            $request->teams
        ));

        flash_success(__('admin.report_updated'));

        return redirect()->route('admin.reports.show', [$report]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
