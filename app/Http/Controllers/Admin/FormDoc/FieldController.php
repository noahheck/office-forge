<?php

namespace App\Http\Controllers\Admin\FormDoc;

use App\FormDoc;
use App\FormDoc\Field;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormDoc $formDoc)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormDoc $formDoc)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormDoc $formDoc)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(FormDoc $formDoc, Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(FormDoc $formDoc, Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormDoc $formDoc, Field $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormDoc $formDoc, Field $field)
    {
        //
    }
}
