<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Jobs\File\Create;
use App\Jobs\File\Update;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\File\Store as StoreRequest;
use App\Http\Requests\Admin\File\Update as UpdateRequest;

use function App\flash_success;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('name')->get();

        return $this->view('admin.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file = new File;
        $file->active = true;
        $file->icon = File::DEFAULT_ICON;

        return $this->view('admin.files.create', compact('file'));
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

        $file = $fileCreated->getFile();

        flash_success(__('admin.file_created'));

        return redirect()->route('admin.files.show', [$file]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return $this->view('admin.files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return $this->view('admin.files.edit', compact('file'));
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
        $this->dispatchNow($fileUpdated = new Update(
            $file,
            $request->name,
            $request->icon,
            $request->has('active')
        ));

        flash_success(__('admin.file_updated'));

        return redirect()->route('admin.files.show', [$file]);
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
