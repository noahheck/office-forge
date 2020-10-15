<?php

namespace App\Http\Controllers;

use App\File;
use App\FormDoc;
use App\FormDoc\Provider as FormDocProvider;
use App\FormDoc\Template;
use App\FormDoc\Template\TemplateProvider;
use App\FormDoc\Transformer\Spreadsheet;
use App\Http\Requests\FormDoc\Store as StoreRequest;
use App\Http\Requests\FormDoc\Update as UpdateRequest;
use App\Http\Requests\FormDoc\Destroy as DestroyRequest;
use App\Jobs\FormDoc\Create;
use App\Jobs\FormDoc\Delete;
use App\Jobs\FormDoc\Update;
use App\Team\MemberProvider;
use App\User;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use function App\flash_error;
use function App\flash_info;
use function App\flash_success;
use function App\format_date;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TemplateProvider $templateProvider, FormDocProvider $formDocProvider)
    {
        $user = $request->user();

        $userOptions = User::ordered()->active()->get();
        $userOptions->load('headshots');

        $selectedUsers = collect([]);

        if ($selectedUserIds = $request->query('users')) {
            $selectedUsers = User::find($selectedUserIds);
        }

        $selectedDocs = collect($request->query('docs') ?? []);

        $from = $request->query('from') ?? $user->today()->format('m/d/Y');
        $to = $request->query('to') ?? $user->today()->format('m/d/Y');
        $includeDrafts = $request->query('includeDrafts') ?? '0';

        $formDocs = $formDocProvider->getFormDocsAccessibleByUser(
            $user,
            $from,
            $to,
            $selectedDocs->toArray(),
            $selectedUserIds ?? [],
            $includeDrafts
        );

        $templates = $templateProvider->getTemplatesCreatableByUser($user, null);

        return $this->view('form-docs.index', compact(
            'formDocs',
            'templates',
            'userOptions',
            'selectedUsers',
            'selectedDocs',
            'from',
            'to',
            'includeDrafts'
        ));
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
        $formDoc->date = $user->today();
        $formDoc->time = $user->today();

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

        $this->dispatchNow($formDocCreated = new Create(
            $template,
            $file,
            null,
            $user,
            $request->date,
            $request->time,
            $submitted,
            $request->all()
        ));

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

            if ($request->ajax() && $request->acceptsJson()) {
                return $this->json(false, [], [__('formDoc.error_unableToAccessFormDoc')]);
            }

            flash_error(__('formDoc.error_unableToAccessFormDoc'));

            return redirect()->route('form-docs.index');
        }

        $file = $formDoc->file;

        $activity = $formDoc->activity;

        if ($request->ajax() && $request->acceptsJson()) {

            $data = [
                'id' => $formDoc->id,
                'title' => $formDoc->name,
                'creator' => $formDoc->creator,
                'content' => $this->view('form-docs._form-doc', compact('formDoc', 'file', 'activity'))->render(),
            ];

            return $this->json(true, $data);
        }


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

        $this->dispatchNow($formDocUpdate = new Update(
            $formDoc,
            $request->date,
            $request->time,
            $submitted,
            $request->all()
        ));

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
    public function destroy(DestroyRequest $request, FormDoc $formDoc)
    {
        $this->dispatchNow($formDocDeleted = new Delete($formDoc, $request->user()));

        flash_info(__('formDoc.deletedSuccessfully'));

        return redirect()->route('home');
    }


    /**
     * @param Request $request
     * @param FormDocProvider $provider
     * @param Spreadsheet $transformer
     * @return false|string
     */
    public function downloadSpreadsheet(Request $request, FormDocProvider $provider, Spreadsheet $transformer)
    {
        $formDocs = $provider->getFormDocsByFormDocIdAccessibleByUser($request->user(), $request->get('formDocIds'));

        $spreadsheet = $transformer->transform($formDocs);

        $user = $request->user();
        $tempFilename = $user->id . '_' . now()->format('Y-m-d_g_i_a');
        $filename = $user->today()->format('Y-m-d_g-ia');

        $format = $request->downloadFormat ?? 'ods';

        if ('xlsx' === $format) {
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $tempFilename .= '.xlsx';
            $filename     .= '.xlsx';
        } else {
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Ods($spreadsheet);
            $tempFilename .= '.ods';
            $filename     .= '.ods';
        }



        $writer->save(\App\temp_directory_path() . "/{$tempFilename}");

        return $this->download(\App\temp_directory_path() . "/{$tempFilename}", $filename)->deleteFileAfterSend(true);
    }
}
