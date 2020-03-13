<?php

namespace App\Http\Controllers\Admin\FileType\Form;

use App\FileType;
use App\FileType\Form;
use App\FileType\Form\Field;
use App\Http\Requests\Admin\FileType\Form\Field\Store as StoreRequest;
use App\Http\Requests\Admin\FileType\Form\Field\Update as UpdateRequest;
use App\Http\Response\AjaxResponse;
use App\Jobs\FileType\Form\Field\Create;
use App\Jobs\FileType\Form\Field\Update;
use App\Jobs\FileType\Form\Fields\UpdateOrder;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function App\flash_success;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  FileType $fileType
     * @param  Form $form
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType, Form $form)
    {
        return $this->view('admin.file-types.forms.fields.index', compact('fileType', 'form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  FileType $fileType
     * @param  Form $form
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType, Form $form)
    {
        $field = new Field;
        $field->file_type_form_id = $form->id;
        $field->active = true;
        $field->field_type = 'text';

        return $this->view('admin.file-types.forms.fields.create', compact('fileType', 'form', 'field'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param FileType $fileType
     * @param Form $form
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
     * @param  FileType $fileType
     * @param  Form $form
     * @param  Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, Form $form, Field $field)
    {
        return $this->view('admin.file-types.forms.fields.show', compact('fileType', 'form', 'field'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FileType $fileType
     * @param  Form $form
     * @param  Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, Form $form, Field $field)
    {
        return $this->view('admin.file-types.forms.fields.edit', compact('fileType', 'form', 'field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  FileType $fileType
     * @param  Form $form
     * @param  Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FileType $fileType, Form $form, Field $field)
    {
        $this->dispatchNow($fieldUpdated = new Update(
            $field,
            $request->label,
            $request->description,
            $request->field_type,
            $request->has('active')
        ));

        flash_success(__('admin.field_updated'));

        if ($returnUrl = $request->return) {

            return redirect($returnUrl);
        }

        return redirect()->route('admin.file-types.forms.show', [$fileType, $form]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FileType $fileType
     * @param  Form $form
     * @param  Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, Form $form, Field $field)
    {
        //
    }


    public function updateOrder(Request $request, FileType $fileType, Form $form)
    {
        $this->dispatchNow($fieldsOrdered = new UpdateOrder($fileType, $form, $request->get('orderedFields')));

        return $this->json(true, [
            'successMessage' => __('admin.fields_orderUpdated'),
        ]);
    }
}
