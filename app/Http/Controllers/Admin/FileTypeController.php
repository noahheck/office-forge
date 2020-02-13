<?php

namespace App\Http\Controllers\Admin;

use App\FileType;
use App\Http\Controllers\Controller;
use App\Jobs\FileType\Create;
use App\Jobs\FileType\Update;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FileType\Store as StoreRequest;
use App\Http\Requests\Admin\FileType\Update as UpdateRequest;

use function App\flash_success;

class FileTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fileTypes = FileType::orderBy('name')->get();

        return $this->view('admin.file-types.index', compact('fileTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fileType = new FileType;
        $fileType->active = true;
        $fileType->icon = FileType::DEFAULT_ICON;

        return $this->view('admin.file-types.create', compact('fileType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($fileCreated = new Create(
            $request->name,
            $request->icon,
            $request->has('active')
        ));

        $fileType = $fileCreated->getFile();

        flash_success(__('admin.fileType_created'));

        return redirect()->route('admin.file-types.show', [$fileType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType)
    {
        return $this->view('admin.file-types.show', compact('fileType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType)
    {
        return $this->view('admin.file-types.edit', compact('fileType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FileType $fileType)
    {
        $this->dispatchNow($fileUpdated = new Update(
            $fileType,
            $request->name,
            $request->icon,
            $request->has('active')
        ));

        flash_success(__('admin.fileType_updated'));

        return redirect()->route('admin.file-types.show', [$fileType]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType)
    {
        //
    }
}
