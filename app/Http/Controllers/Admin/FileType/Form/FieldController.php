<?php

namespace App\Http\Controllers\Admin\FileType\Form;

use App\FileType;
use App\FileType\Form;
use App\FileType\Form\Field;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType, Form $form)
    {
        return $this->view('admin.file-types.forms.fields.index', compact('fileType', 'form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType, Form $form)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FileType $fileType, Form $form)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @param  \App\FileType\Form\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, Form $form, Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @param  \App\FileType\Form\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, Form $form, Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @param  \App\FileType\Form\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileType $fileType, Form $form, Field $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @param  \App\FileType\Form\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, Form $form, Field $field)
    {
        //
    }
}
