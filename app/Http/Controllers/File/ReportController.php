<?php

namespace App\Http\Controllers\File;

use App\File;
use App\Http\Controllers\Controller;
use App\Report;
use App\Report\Compiler;
use App\Report\Provider;
use App\Report\RuntimeValues;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(
        Request $request,
        File $file,
        Provider $reportProvider,
        User $user,
        Report $reportModel,
        Compiler $reportCompiler
    ) {
        $fileType = $file->fileType;

        $userOptions = $user->active()->ordered()->get();

        $userOptions->load('headshots');

        $report_id = $request->query('report_id', '');
        $user_id = (int) $request->query('user_id', '');
        $date = $request->query('date', '');
        $date_from = $request->query('date_from', '');
        $date_to = $request->query('date_to', '');

        $reports = $reportProvider->getReportsAccessibleByUser($request->user(), $file->file_type_id);

        $report = false;
        $compiledReport = false;

        if ($report_id) {
            $report = $reportModel->find($report_id);
            $report->load('datasets', 'datasets.datasetable', 'datasets.datasetable', 'datasets.fields', 'datasets.fields');

            $runtimeValues = RuntimeValues::fromRequest($request)->withFileId($file->id);

            $compiledReport = $reportCompiler->compileReport($report, $runtimeValues);
        }

        return $this->view('files.reports.index', compact(
            'file',
            'fileType',
            'report_id',
            'userOptions',
            'user_id',
            'date',
            'date_from',
            'date_to',
            'reports',
            'compiledReport'
        ));
    }
}
