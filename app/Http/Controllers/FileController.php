<?php

namespace App\Http\Controllers;

use App\File;
use App\FileType;
use App\Jobs\File\Create;
use Illuminate\Http\Request;
use App\Http\Requests\File\Store as StoreRequest;
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

            $files = File::where('file_type_id', $fileTypeFilter)->where('archived', false)->get();
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
            \App\flash_error(__('file.error_invalidFileType'));

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
            \App\flash_error(__('file.error_invalidFileType'));

            return redirect()->route('files.index');
        }

        $this->dispatchNow($fileCreated = new Create(
            $fileType,
            $request->name
        ));

        $file = $fileCreated->getFile();

        flash_success(__('file.fileOfTypeCreated', ['fileTypeName' => $fileType->name, 'fileName' => $file->name]));

        return redirect()->route('files.show', [$file]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
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
