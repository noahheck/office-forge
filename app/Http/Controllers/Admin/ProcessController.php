<?php

namespace App\Http\Controllers\Admin;

use App\FileType;
use App\FormDoc\Template;
use App\Http\Controllers\Controller;
use App\Jobs\Process\Create;
use App\Jobs\Process\Template\Add;
use App\Jobs\Process\Template\Remove;
use App\Jobs\Process\Update;
use App\Process;
use App\Team;
use App\Http\Requests\Admin\Process\Store as StoreRequest;
use App\Http\Requests\Admin\Process\Update as UpdateRequest;
use App\Http\Requests\Admin\Process\AddTemplate as AddTemplateRequest;
use App\Http\Requests\Admin\Process\RemoveTemplate as RemoveTemplateRequest;
use Illuminate\Http\Request;
use function App\flash_error;
use function App\flash_success;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::orderBy('name')->get();

        return $this->view('admin.processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $process = new Process();
        $process->active = true;

        if ($fileTypeId = $request->query('file_type_id')) {
            $process->file_type_id = $fileTypeId;
        }

        $teamOptions = Team::orderBy('name')->get();
        $fileTypeOptions = FileType::orderBy('name')->get();

        return $this->view('admin.processes.create', compact('process', 'teamOptions', 'fileTypeOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($processCreated = new Create(
            $request->name,
            $request->file_type_id,
            $request->has('active'),
            $request->details,
            $request->teams,
            $request->temp_id
        ));

        $process = $processCreated->getProcess();

        \App\flash_success(__('admin.process_created'));

        /*if ($return = $request->return) {

            return redirect($return);
        }*/

        return redirect()->route('admin.processes.show', [$process]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {
        $process->load('tasks', 'templates');

        if ($fileType = $process->fileType) {
            $templateOptions = $fileType->formDocTemplates()->active()->get();
        } else {
            $templateOptions = Template::active()->whereNull('file_type_id')->orderBy('name')->get();
        }

        $templateOptions = $templateOptions->pluck('name', 'id');

        return $this->view('admin.processes.show', compact('process', 'templateOptions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        $teamOptions = Team::orderBy('name')->get();
        $fileTypeOptions = FileType::orderBy('name')->get();

        return $this->view('admin.processes.edit', compact('process', 'teamOptions', 'fileTypeOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Process $process)
    {
        $this->dispatchNow($processUpdated = new Update(
            $process,
            $request->name,
            $request->file_type_id,
            $request->has('active'),
            $request->details,
            $request->teams
        ));

        \App\flash_success(__('admin.process_updated'));

        return redirect()->route('admin.processes.show', [$process]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        //
    }

    public function addTemplate(AddTemplateRequest $request, Process $process)
    {
        $template = Template::find($request->template_id);

        if (!$template || ($template->file_type_id !== $process->file_type_id)) {
            flash_error(__('admin.process_error_invalidFormDocTemplate'));

            return redirect()->route('admin.processes.show', [$process]);
        }

        $this->dispatchNow($templateAdded = new Add($process, $template));

        flash_success(__('admin.process_templateAdded'));

        return redirect()->route('admin.processes.show', [$process]);
    }

    public function removeTemplate(RemoveTemplateRequest $request, Process $process)
    {
        $template = Template::find($request->template_id);

        if (!$template) {
            flash_error(__('admin.process_error_invalidFormDocTemplate'));

            return redirect()->route('admin.processes.show', [$process]);
        }

        $this->dispatchNow($templateRemoved = new Remove($process, $template));

        flash_success(__('admin.process_templateAdded'));

        return redirect()->route('admin.processes.show', [$process]);
    }
}
