<?php

namespace App\Http\Controllers;

use App\FormDoc;
use App\FormDoc\Template;
use Illuminate\Http\Request;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Temporarily return all instances
        $formDocs = FormDoc::published()->orderBy('published_at')->get();

        $formDocs->load('creator, file');

        $templates = Template::whereNull('file_type_id')->active()->orderBy('name')->get();

        $templates->load('teams');

        $templates = $templates->filter(function($template) use ($user) {

            return $template->isAccessibleBy($user);
        });

        return $this->view('form-docs.index', compact('formDocs', 'templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function show(FormDoc $formDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function edit(FormDoc $formDoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormDoc $formDoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDoc  $formDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormDoc $formDoc)
    {
        //
    }
}
