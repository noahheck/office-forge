<?php

namespace App\Http\Controllers;

use App\Chart\PieChart;
use App\Report;
use App\Report\RuntimeValues;
use App\Report\Compiler;
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
        Compiler $reportCompiler
    ) {
        $reports = $reportProvider->getReportsAccessibleByUser($request->user(), null);

        $userOptions = $user->active()->ordered()->get();

        $userOptions->load('headshots');


        $report_id = $request->query('report_id', '');
        $user_id = (int) $request->query('user_id', '');
        $date = $request->query('date', '');
        $date_from = $request->query('date_from', '');
        $date_to = $request->query('date_to', '');

        $report = false;
        $compiledReport = false;

        if ($report_id) {
            $report = $reportModel->find($report_id);
            $report->load('datasets', 'datasets.datasetable', 'datasets.datasetable', 'datasets.fields', 'datasets.fields');

            $runtimeValues = RuntimeValues::fromRequest($request);

            $compiledReport = $reportCompiler->compileReport($report, $runtimeValues);
        }




        /*$chart = new PieChart('Test Chart');

        $chart->addDataToDataset('Noah', 30)
            ->addDataToDataset('Heidi', 50)
            ->addDataToDataset('Ella', 15)
            ->addDataToDataset('Kenji', 10);*/





        return $this->view('reports.index', compact(
            'reports',
            'userOptions',
            'report_id',
            'user_id',
            'date',
            'date_from',
            'date_to',
            'report',
            'compiledReport'
        ));
    }
}
