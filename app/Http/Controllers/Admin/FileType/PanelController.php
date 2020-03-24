<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType)
    {

        return $this->view('admin.file-types.panels.index', compact('fileType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FileType $fileType)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, Panel $panel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, Panel $panel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileType $fileType, Panel $panel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, Panel $panel)
    {
        //
    }
}
