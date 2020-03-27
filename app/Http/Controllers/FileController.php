<?php

namespace App\Http\Controllers;

use App\File;
use App\FileType;
use App\Jobs\File\Create;
use App\Jobs\File\Update;
use App\Jobs\Headshottable\Upload;
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

        if ($fileTypeFilter = $request->query('file_type')) {
            $fileType = FileType::find($fileTypeFilter);

            $files = File::where('file_type_id', $fileTypeFilter)->where('archived', false)->orderBy('name')->get();
        } else {
            $fileTypes = FileType::orderBy('name')->get();
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

        $this->dispatchNow($fileCreated = new Create(
            $fileType,
            $request->name
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
    public function show(Request $request, File $file)
    {
        $user     = $request->user();
        $fileType = $file->fileType;

        $fileType->load(['forms', 'forms.teams', 'panels', 'panels.teams', 'panels.fields']);

        $forms = $fileType->forms->filter(function($form, $key) use($user) {
            return $form->isAccessibleBy($user);
        });

        $panels = $fileType->panels->filter(function($panel, $key) use($user) {
            return $panel->isAccessibleBy($user);
        });

        $values   = $file->formFieldValues;

        return $this->view('files.show', compact('file', 'fileType', 'forms', 'panels', 'values'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
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
        $this->dispatchNow($fileUpdated = new Update($file, $request->name));

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
    public function destroy(File $file)
    {
        //
    }
}
