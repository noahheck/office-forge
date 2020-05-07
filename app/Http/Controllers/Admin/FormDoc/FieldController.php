<?php

namespace App\Http\Controllers\Admin\FormDoc;

use App\FileType;
use App\FormDoc;
use App\FormDoc\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormDoc\Field\Store as StoreRequest;
use App\Http\Requests\Admin\FormDoc\Field\Update as UpdateRequest;
use App\Jobs\FormDoc\Field\Create;
use App\Jobs\FormDoc\Field\Update;
use App\Jobs\FormDoc\Fields\UpdateOrder;
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
        return $this->view('admin.form-docs.fields.show', compact('formDoc', 'field'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(FormDoc $formDoc, Field $field)
    {
        $allTeams = Team::all();
        $allFileTypes = FileType::all();

        return $this->view('admin.form-docs.fields.edit', compact(
            'formDoc',
            'field',
            'allTeams',
            'allFileTypes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FormDoc $formDoc, Field $field)
    {
        $this->dispatchNow($fieldUpdated = new Update(
            $field,
            $request->label,
            $request->description,
            $request->field_type,
            $request->has('separator'),
            $request->has('active'),
            $request->select_options,
            $request->decimal_places,
            $request->user_team,
            $request->file_type
        ));

        flash_success(__('admin.field_updated'));

        $returnUrl = $request->has('return') ? $request->return : route('admin.form-docs.show', [$formDoc]);

        return redirect($returnUrl);
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


    public function updateOrder(Request $request, FormDoc $formDoc)
    {
        $this->dispatchNow($fieldsOrdered = new UpdateOrder($formDoc, $request->get('orderedFields')));

        return $this->json(true, [
            'successMessage' => __('admin.fields_orderUpdated'),
        ]);
    }
}
