<?php

namespace App\Http\Controllers;

use App\File;
use App\FormDoc;
use App\FormDoc\Template;
use App\Http\Requests\FormDoc\Store as StoreRequest;
use App\Http\Requests\FormDoc\Update as UpdateRequest;
use App\Jobs\FormDoc\Create;
use App\Jobs\FormDoc\Update;
use App\Team\MemberProvider;
use Illuminate\Http\Request;
use function App\flash_error;
use function App\flash_success;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Temporarily return all instances
        $formDocs = FormDoc::submitted()->orderBy('submitted_at', 'DESC')->get();
        $formDocs->load(['creator', 'file', 'teams']);

        $formDocs = $formDocs->filter(function($formDoc, $key) use ($user) {

            return $user->can('view', $formDoc);
        });

        // @todo Replace with TemplateProvider
        $templates = Template::whereNull('file_type_id')->active()->orderBy('name')->get();
        $templates->load('teams');
        $templates = $templates->filter(function($template) use ($user) {

            return $user->can('create', [FormDoc::class, $template]);
        });

        return $this->view('form-docs.index', compact('formDocs', 'templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, MemberProvider $memberProvider)
    {
        $user = $request->user();

        $templateId = $request->query('form_doc_template_id');
        $template = Template::find($templateId);
        if (!$template || !$user->can('create', [FormDoc::class, $template])) {
            flash_error(__('formDoc.error_unableToAccessFormDocType'));

            return redirect()->route('form-docs.index');
        }

        $fileId = $request->query('file_id');
        $file = File::find($fileId);
        if ($file && !$user->can('view', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        if ($fileId && ($template->file_type_id != $file->file_type_id)) {
            flash_error(__('formDoc.error_fileIdMismatch'));

            return redirect()->route('form-docs.index');
        }

        if (!$fileId && $template->file_type_id !== null) {
            flash_error(__('formDoc.error_fileTypeIdMismatch'));

            return redirect()->route('form-docs.index');
        }

        $formDoc = new FormDoc();
        $formDoc->form_doc_template_id = $templateId;
        $formDoc->file_id = ($fileId) ? $fileId : null;
        $formDoc->creator_id = $user->id;
        $formDoc->name = $template->name;

        return $this->view('form-docs.create', compact('template', 'file', 'formDoc', 'memberProvider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $user = $request->user();

        $template = Template::find($request->form_doc_template_id);

        if (!$template || !$user->can('create', [FormDoc::class, $template])) {
            flash_error(__('formDoc.error_unableToAccessFormDocType'));

            return redirect()->route('form-docs.index');
        }

        $file = ($fileId = $request->file_id) ? File::find($fileId) : null;

        if ($file && !$user->can('view', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        if ($fileId && ($template->file_type_id != $file->file_type_id)) {
            flash_error(__('formDoc.error_fileIdMismatch'));

            return redirect()->route('form-docs.index');
        }

        $submitted = $request->has('save_submit');

        $this->dispatchNow($formDocCreated = new Create($template, $file, null, $user, $submitted, $request->all()));

        $formDoc = $formDocCreated->getFormDoc();

        $message = ($submitted) ? __('formDoc.submittedSuccessfully') : __('formDoc.savedSuccessfully');
        flash_success($message);

        if ($return = $request->get('return')) {

            return redirect($return);
        }

        if ($file) {

            return redirect()->route('files.show', [$file]);
        }

        return redirect()->route('form-docs.show', [$formDoc]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FormDoc $formDoc)
    {
        if (!$request->user()->can('view', $formDoc)) {
            flash_error(__('formDoc.error_unableToAccessFormDoc'));

            return redirect()->route('form-docs.index');
        }

        $file = $formDoc->file;

        $activity = $formDoc->activity;

        return $this->view('form-docs.show', compact('formDoc', 'file', 'activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FormDoc $formDoc, MemberProvider $memberProvider)
    {
        if ($formDoc->isSubmitted()) {

            flash_error(__('formDoc.error_formDocAlreadySubmitted'));

            return redirect(url()->previous());
        }

        if (!$request->user()->can('update', $formDoc)) {
            flash_error(__('formDoc.error_unableToAccessFormDoc'));

            return redirect(url()->previous());
        }

        $file = $formDoc->file;

        return $this->view('form-docs.edit', compact('formDoc', 'file', 'memberProvider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FormDoc $formDoc)
    {
        if ($formDoc->isSubmitted()) {

            flash_error(__('formDoc.error_formDocAlreadySubmitted'));

            return redirect(url()->previous());
        }

        if (!$request->user()->can('update', $formDoc)) {
            flash_error(__('formDoc.error_unableToAccessFormDoc'));

            return redirect(url()->previous());
        }

        $submitted = $request->has('save_submit');

        $this->dispatchNow($formDocUpdate = new Update($formDoc, $submitted, $request->all()));

        $message = ($submitted) ? __('formDoc.submittedSuccessfully') : __('formDoc.savedSuccessfully');
        flash_success($message);

        if ($return = $request->get('return')) {

            return redirect($return);
        }

        if ($file = $formDoc->file) {

            return redirect()->route('files.show', [$file]);
        }

        return redirect()->route('form-docs.show', [$formDoc]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormDoc $formDoc)
    {
        //
    }
}
