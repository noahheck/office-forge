<?php

namespace App\Http\Controllers\Admin;

use App\FileType;
use App\FormDoc\Template;
use App\Http\Controllers\Controller;
use App\Jobs\FormDoc\Template\Create;
use App\Jobs\FormDoc\Template\Update;
use App\Team;
use App\Team\MemberProvider;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FormDoc\Store as StoreRequest;
use App\Http\Requests\Admin\FormDoc\Update as UpdateRequest;
use function App\flash_success;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::orderBy('name')->get();

        return $this->view('admin.form-docs.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $template = new Template();
        $template->active = true;

        if ($file_type_id = $request->file_type_id) {
            $template->file_type_id = $file_type_id;
        }

        $teamOptions = Team::orderBy('name')->get();

        $canSelectFileType = true;
        $fileTypeSelectOptions = FileType::orderBy('name')->get();

        return $this->view('admin.form-docs.create', compact(
            'template',
            'teamOptions',
            'canSelectFileType',
            'fileTypeSelectOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($templateCreated = new Create(
            $request->name,
            $request->teams,
            $request->file_type_id
        ));

        $template = $templateCreated->getTemplate();

        flash_success(__('admin.formDoc_created'));

        return redirect()->route('admin.form-docs.show', [$template]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormDoc\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $formDoc, MemberProvider $memberProvider)
    {
        $template = $formDoc;

        return $this->view('admin.form-docs.show', compact('template', 'memberProvider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $formDoc)
    {
        $template = $formDoc;

        $teamOptions = Team::orderBy('name')->get();

        $canSelectFileType = is_null($template->last_created_at);
        $fileTypeSelectOptions = FileType::orderBy('name')->get();

        return $this->view('admin.form-docs.edit', compact(
            'template',
            'teamOptions',
            'canSelectFileType',
            'fileTypeSelectOptions'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Template $formDoc)
    {
        $template = $formDoc;
        $this->dispatchNow($templateUpdated = new Update(
            $template,
            $request->name,
            $request->teams,
            $request->file_type_id,
            $request->has('active')
        ));

        flash_success(__('admin.formDoc_updated'));

        return redirect()->route('admin.form-docs.show', [$formDoc]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDoc\Template  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $formDoc)
    {
        $template = $formDoc;
    }
}
