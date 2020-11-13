<?php

namespace App\Http\Controllers\Admin\Report;

use App\FileType;
use App\FormDoc\Template\TemplateProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\Datasets\Store as StoreRequest;
use App\Http\Requests\Admin\Reports\Datasets\Update as UpdateRequest;
use App\Jobs\Report\Dataset\Create;
use App\Jobs\Report\Dataset\Update;
use App\Report;
use App\Report\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function App\flash_success;

class DatasetController extends Controller
{

    /**
     * @var TemplateProvider
     */
    private $templateProvider;

    public function __construct(TemplateProvider $templateProvider)
    {
        $this->templateProvider = $templateProvider;
    }

    private function getDatasetableIdFromRequest($request)
    {
        $datasetableId = null;

        switch($request->datasetable_type):

            case ("App\\FileType"):
                $datasetableId = $request->App_FileType_datasetable_id;
                break;

            case ("App\\FormDoc\\Template"):
                $datasetableId = $request->App_FormDoc_Template_datasetable_id;
                break;

        endswitch;

        return $datasetableId;
    }

    private function getFormDocTemplateOptions()
    {
        $templates = $this->templateProvider->getAllTemplates(false);

        $templates->load('fileType');

        $formDocTemplateOptions = $templates->groupBy(function($template) {

            return ($template->file_type_id) ? $template->fileType->name : "";
        })
        ->map(function($templateSet, $fileTypeName) {

            return $templateSet->pluck('name', 'id');
        });

        return $formDocTemplateOptions;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report)
    {
        $datasets = $report->datasets;

        return $this->view('admin.reports.datasets.index', compact('report', 'datasets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function create(Report $report, TemplateProvider $templateProvider)
    {
        $dataset = new Dataset;
        $dataset->report_id = $report->id;

        $fileTypeOptions = FileType::ordered()->get();
        $formDocTemplateOptions = $this->getFormDocTemplateOptions();

        return $this->view('admin.reports.datasets.create', compact(
            'report',
            'dataset',
            'fileTypeOptions',
            'formDocTemplateOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Report $report)
    {
        $datasetableId = $this->getDatasetableIdFromRequest($request);

        $this->dispatchNow($datasetCreated = new Create(
            $report,
            $request->name,
            $request->datasetable_type,
            $datasetableId
        ));

        $dataset = $datasetCreated->getDataset();

        flash_success(__('admin.dataset_created'));

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
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

        return $this->view('admin.reports.datasets.show', compact('report', 'dataset'));
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
        $fileTypeOptions = FileType::ordered()->get();
        $formDocTemplateOptions = $this->getFormDocTemplateOptions();

        return $this->view('admin.reports.datasets.edit', compact(
            'report',
            'dataset',
            'fileTypeOptions',
            'formDocTemplateOptions'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @param  \App\Report\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Report $report, Dataset $dataset)
    {
        $this->dispatchNow($datasetUpdated = new Update(
            $dataset,
            $request->name,
            $request->datasetable_type,
            $this->getDatasetableIdFromRequest($request)
        ));

        flash_success(__('admin.dataset_updated'));

        return redirect()->route('admin.reports.datasets.show', [$report, $dataset]);
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
