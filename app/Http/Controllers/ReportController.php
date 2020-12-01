<?php

namespace App\Http\Controllers;

use App\Report;
use App\Report\Provider;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(
        Request $request,
        Provider $reportProvider,
        User $user,
        Report $reportModel,
        Report\Dataset\Renderer $datasetRenderer
    )
    {
        $reports = $reportProvider->getReportsAccessibleByUser($request->user(), null);

        $userOptions = $user->active()->ordered()->get();

        $userOptions->load('headshots');


        $report_id = $request->query('report_id', '');
        $user_id = (int) $request->query('user_id', '');
        $date = $request->query('date', '');
        $date_from = $request->query('date_from', '');
        $date_to = $request->query('date_to', '');

        $report = false;

        if ($report_id) {
            $report = $reportModel->find($report_id);

//            $report->load('datasets', 'datasets.datasetable', 'datasets.datasetable', 'datasets.fields', 'datasets.fields.field');
        }

        $datasetRenderer->setReportOptions($request->user(), $user_id, $date, $date_from, $date_to);


        return $this->view('reports.index', compact(
            'reports',
            'userOptions',
            'report_id',
            'user_id',
            'date',
            'date_from',
            'date_to',
            'report',
            'datasetRenderer'
        ));
    }
}
