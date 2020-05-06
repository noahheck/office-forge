<?php

namespace App\Http\Controllers\Admin\FormDoc;

use App\FileType;
use App\FormDoc;
use App\FormDoc\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormDoc\Field\Store as StoreRequest;
use App\Jobs\FormDoc\Field\Create;
use App\Team;
use Illuminate\Http\Request;
use function App\flash_success;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormDoc $formDoc)
    {
        return $this->view('admin.form-docs.fields.index', compact('formDoc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormDoc $formDoc)
    {
        $field = new Field();
        $field->active = true;
        $field->form_doc_id = $formDoc->id;
        $field->type = 'text';

        $allTeams = Team::all();
        $allFileTypes = FileType::all();

        return $this->view('admin.form-docs.fields.create', compact(
            'fileType',
            'formDoc',
            'field',
            'allTeams',
            'allFileTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, FormDoc $formDoc)
    {
        $this->dispatchNow($fieldCreated = new Create(
            $formDoc,
            $request->label,
            $request->description,
            $request->field_type,
            $request->has('separator'),
            $request->select_options,
            $request->decimal_places,
            $request->user_team,
            $request->file_type
        ));

        flash_success(__('admin.field_created'));

        $url = ($request->has('return')) ? $request->return : route('admin.form-docs.show', [$formDoc]);

        return redirect($url);
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
