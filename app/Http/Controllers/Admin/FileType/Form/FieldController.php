<?php

namespace App\Http\Controllers\Admin\FileType\Form;

use App\FileType;
use App\FileType\Form;
use App\FileType\Form\Field;
use App\Http\Requests\Admin\FileType\Form\Field\Store as StoreRequest;
use App\Jobs\FileType\Form\Field\Create;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function App\flash_success;

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
        $field = new Field;
        $field->file_type_form_id = $form->id;
        $field->active = true;
        $field->panel_display = false;

        return $this->view('admin.file-types.forms.fields.create', compact('fileType', 'form', 'field'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType $fileType
     * @param  \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, FileType $fileType, Form $form)
    {
        $this->dispatchNow($fieldCreated = new Create(
            $form,
            $request->label,
            $request->description,
            $request->field_type
        ));

        flash_success(__('admin.field_created'));

        return redirect()->route('admin.file-types.forms.show', [$fileType, $form]);
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
        return $this->view('admin.file-types.forms.fields.show', compact('fileType', 'form', 'field'));
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
