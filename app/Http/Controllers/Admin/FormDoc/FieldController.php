<?php

namespace App\Http\Controllers\Admin\FormDoc;

use App\FileType;
use App\FormDoc\Template;
use App\FormDoc\Template as FormDoc;
use App\FormDoc\Template\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormDoc\Field\Store as StoreRequest;
use App\Http\Requests\Admin\FormDoc\Field\Update as UpdateRequest;
use App\Jobs\FormDoc\Template\Field\Create;
use App\Jobs\FormDoc\Template\Field\Update;
use App\Jobs\FormDoc\Template\Fields\UpdateOrder;
use App\Team;
use App\Team\MemberProvider;
use Illuminate\Http\Request;
use function App\flash_success;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Template $formDoc, MemberProvider $memberProvider)
    {
        $template = $formDoc;

        return $this->view('admin.form-docs.fields.index', compact('template', 'memberProvider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Template $formDoc)
    {
        $template = $formDoc;

        $field = new Field();
        $field->active = true;
        $field->form_doc_id = $formDoc->id;
        $field->type = 'text';

        $allTeams = Team::all();
        $allFileTypes = FileType::all();

        return $this->view('admin.form-docs.fields.create', compact(
            'fileType',
            'template',
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
    public function store(StoreRequest $request, Template $formDoc)
    {
        $template = $formDoc;

        $this->dispatchNow($fieldCreated = new Create(
            $template,
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

        $url = ($request->has('return')) ? $request->return : route('admin.form-docs.show', [$template]);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Template $formDoc, Field $field)
    {
        $template = $formDoc;

        return $this->view('admin.form-docs.fields.show', compact('template', 'field'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $formDoc, Field $field)
    {
        $template = $formDoc;

        $allTeams = Team::all();
        $allFileTypes = FileType::all();

        return $this->view('admin.form-docs.fields.edit', compact(
            'template',
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
    public function update(UpdateRequest $request, Template $formDoc, Field $field)
    {
        $template = $formDoc;

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

        $returnUrl = $request->has('return') ? $request->return : route('admin.form-docs.show', [$template]);

        return redirect($returnUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDoc\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $formDoc, Field $field)
    {
        $template = $formDoc;
    }


    public function updateOrder(Request $request, Template $formDoc)
    {
        $template = $formDoc;

        $this->dispatchNow($fieldsOrdered = new UpdateOrder($template, $request->get('orderedFields')));

        return $this->json(true, [
            'successMessage' => __('admin.fields_orderUpdated'),
        ]);
    }
}
