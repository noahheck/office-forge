<?php

namespace App\Http\Controllers;

use App\Activity\ActivityProvider;
use App\Document\DocumentProvider;
use App\File;
use App\FileType;
use App\FormDoc\Template\TemplateProvider;
use App\Jobs\File\Create;
use App\Jobs\File\Update;
use App\Jobs\Headshottable\Upload;
use App\Process\ProcessProvider;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\File\Store as StoreRequest;
use App\Http\Requests\File\Update as UpdateRequest;
use function App\flash_error;
use function App\flash_success;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fileType  = null;
        $fileTypes = [];
        $files     = [];

        $user = $request->user();

        if ($fileTypeFilter = $request->query('file_type')) {
            $fileType = FileType::find($fileTypeFilter);

            if (!$user->can('viewAny', [File::class, $fileType])) {
                flash_error(__('file.error_unableToAccessFileType'));

                return redirect()->route('files.index');
            }

            $files = File::where('file_type_id', $fileTypeFilter)
                ->where('archived', false)
                ->orderBy('name')
                ->get();

            $files->load('fileType', 'fileType.teams', 'accessLocks');
        } else {
            $fileTypes = FileType::active()->orderBy('name')->get();
            $fileTypes->load('teams');


            $fileTypes = $fileTypes->filter(function($fileType) use ($user) {
                return $user->can('view', $fileType);
            });
        }

        return $this->view('files.index', compact('fileTypes', 'fileType', 'fileTypeFilter', 'files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fileTypeId = $request->query('file_type');

        $fileType = FileType::find($fileTypeId);

        if (!(optional($fileType)->id)) {
            flash_error(__('file.error_invalidFileType'));

            return redirect()->route('files.index');
        }

        if (!$request->user()->can('create', [File::class, $fileType])) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        $file = new File();
        $file->file_type_id = $fileType->id;

        return $this->view('files.create', compact('file', 'fileType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $fileTypeId = $request->file_type_id;

        $fileType = FileType::find($fileTypeId);

        if (!(optional($fileType)->id)) {
            flash_error(__('file.error_invalidFileType'));

            return redirect()->route('files.index');
        }

        if (!$request->user()->can('create', [File::class, $fileType])) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        $this->dispatchNow($fileCreated = new Create(
            $fileType,
            $request->name,
            $request->accessLocks
        ));

        $file = $fileCreated->getFile();

        if ($photoFile = $request->file('new_file_photo')) {
            $this->dispatchNow($photoUploaded = new Upload($file, $photoFile, $request->user()));
        }

        flash_success(__('file.fileOfTypeCreated', ['fileTypeName' => $fileType->name, 'fileName' => $file->name]));

        return redirect()->route('files.show', [$file]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        File $file,
        ActivityProvider $activityProvider,
        DocumentProvider $documentProvider,
        TemplateProvider $templateProvider,
        ProcessProvider $processProvider
    ) {
        $user     = $request->user();

        if (!$user->can('view', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        $user->load('myFiles');

        $inMyFiles = $user->inMyFiles($file);

        $fileType = $file->fileType;

        $fileType->load(['forms', 'forms.teams', 'panels', 'panels.teams', 'panels.fields']);

        $forms = $fileType->forms->filter(function($form) use($user) {
            return $user->can('view', $form);
        });

        $panels = $fileType->panels->filter(function($panel) use($user) {
            return $user->can('view', $panel);
        });

        $formDocTemplates = $templateProvider->getTemplatesCreatableByUser($user, $file->file_type_id);

        $processesToCreate = $processProvider->getProcessesCreatableByUser($user, $file->file_type_id);

        $values = $file->formFieldValues;

        // Default is to get open activities for this file
        $activityView = $request->query('show_activities', 'open');
        switch ($activityView):

            case 'open':
                $activities = $activityProvider->getOpenActivitiesForFileAccessibleByUser($file, $user);
                break;

            case 'all':
                $activities = $activityProvider->getAllActivitiesForFileAccessibleByUser($file, $user);
                break;

        endswitch;

        $activities->load('owner', 'owner.headshots', 'tasks', 'formDocs');

        $documents = $documentProvider->getDocumentsForFileAccessibleByUser($file, $user);

        $documents->loadMissing('creator', 'teams', 'activity');

        return $this->view('files.show', compact(
            'file',
            'inMyFiles',
            'fileType',
            'forms',
            'panels',
            'processesToCreate',
            'values',
            'activities',
            'activityView',
            'documents',
            'formDocTemplates'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, File $file)
    {
        if (!$request->user()->can('update', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        $fileType = $file->fileType;

        return $this->view('files.edit', compact('file', 'fileType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, File $file)
    {
        if (!$request->user()->can('update', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        $this->dispatchNow($fileUpdated = new Update($file, $request->name, $request->accessLocks));

        if ($photoFile = $request->file('new_file_photo')) {
            $this->dispatchNow($photoUploaded = new Upload($file, $photoFile, $request->user()));
        }

        flash_success(__('file.fileOfTypeUpdated', ['fileTypeName' => $file->fileType->name, 'fileName' => $file->name]));

        return redirect()->route('files.show', [$file]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
//    public function destroy(File $file)
//    {
        //
//    }

    /**
     * Show the users who can access this File
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function access(Request $request, File $file)
    {
        $user = $request->user();

        if (!$user->can('view', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        $fileType = $file->fileType;

        $users = User::active()->ordered()->get();
        $users->load('teams', 'accessKeys', 'headshots');

        $accessingUsers = $users->filter(function($user) use ($file) {

            return $user->can('view', $file);
        });

        return $this->view('files.access', compact('file', 'fileType', 'accessingUsers'));
    }
}
