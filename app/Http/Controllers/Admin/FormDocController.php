<?php

namespace App\Http\Controllers\Admin;

use App\FormDoc;
use App\Http\Controllers\Controller;
use App\Jobs\FormDoc\Create;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FormDocs\Store as StoreRequest;
use function App\flash_success;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formDocs = FormDoc::orderBy('name')->get();

        return $this->view('admin.form-docs.index', compact('formDocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $formDoc = new FormDoc();
        $formDoc->active = true;
        if ($file_type_id = $request->file_type_id) {
            $formDoc->file_type_id = $file_type_id;
        }

        return $this->view('admin.form-docs.create', compact('formDoc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($formDocCreated = new Create($request->name, $request->file_type_id));

        $formDoc = $formDocCreated->getFormDoc();

        flash_success(__('admin.formDoc_created'));

        return redirect()->route('admin.form-docs.show', [$formDoc]);
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
