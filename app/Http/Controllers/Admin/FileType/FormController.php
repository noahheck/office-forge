<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\Form;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileType\Form\Store as StoreRequest;
use App\Http\Requests\Admin\FileType\Form\Update as UpdateRequest;
use App\Jobs\FileType\Form\Create;
use App\Jobs\FileType\Form\Update;
use App\Jobs\FileType\Forms\UpdateOrder;
use App\Team;
use App\Team\MemberProvider;
use Illuminate\Http\Request;
use function App\flash_success;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FileType $fileType
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType)
    {

        return $this->view('admin.file-types.forms.index', compact('fileType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FileType $fileType
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType)
    {
        $teamOptions = Team::all();

        $form = new Form;
        $form->active = true;
        $form->file_type_id = $fileType->id;

        return $this->view('admin.file-types.forms.create', compact('fileType', 'form', 'teamOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param FileType $fileType
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, FileType $fileType)
    {
        $this->dispatchNow($formCreated = new Create($fileType, $request->name, $request->teams));

        flash_success(__('admin.form_created'));

        $form = $formCreated->getForm();

        return redirect()->route('admin.file-types.forms.show', [$fileType, $form]);
    }

    /**
     * Display the specified resource.
     *
     * @param FileType $fileType
     * @param \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, Form $form, MemberProvider $memberProvider)
    {
        return $this->view('admin.file-types.forms.show', compact('fileType', 'form', 'memberProvider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FileType $fileType
     * @param \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, Form $form)
    {
        $teamOptions = Team::all();

        return $this->view('admin.file-types.forms.edit', compact('fileType', 'form', 'teamOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param FileType $fileType
     * @param \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FileType $fileType, Form $form)
    {
        $this->dispatchNow($formUpdated = new Update($form, $request->name, $request->teams, $request->has('active')));

        flash_success(__('admin.form_updated'));

        return redirect()->route('admin.file-types.forms.show', [$fileType, $form]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\FileType\Form $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, Form $form)
    {
        //
    }


    public function updateOrder(Request $request, FileType $fileType)
    {
        $this->dispatchNow($formsOrdered = new UpdateOrder($fileType, $request->get('orderedForms')));

        return $this->json(true, [
            'successMessage' => __('admin.forms_orderUpdated'),
        ]);
    }

}
