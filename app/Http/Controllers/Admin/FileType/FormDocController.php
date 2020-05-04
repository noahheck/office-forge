<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\FormDoc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType)
    {
        return $this->view('admin.file-types.form-docs.index', compact('fileType'));
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
     * @param  \App\FileType\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, FormDoc $formDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, FormDoc $formDoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileType $fileType, FormDoc $formDoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, FormDoc $formDoc)
    {
        //
    }
}
