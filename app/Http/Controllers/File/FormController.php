<?php

namespace App\Http\Controllers\File;

use App\File;
use App\FileType\Form;
use App\Http\Controllers\Controller;
use App\Jobs\File\Form\Update;
use Illuminate\Http\Request;
use App\Http\Requests\File\Forms\Update as UpdateRequest;
use function App\flash_success;

class FormController extends Controller
{
    public function index(File $file)
    {
        $fileType = $file->fileType;

        $forms = $fileType->forms;// Filter for team restrictions here

        return $this->view('files.forms.index', compact('file', 'fileType', 'forms'));
    }

    public function show(File $file, Form $form)
    {
        $fileType = $file->fileType;

        $values = $file->formFieldValues;

        // Make sure user has permission to view this form here

        return $this->view('files.forms.show', compact('file', 'fileType', 'form', 'values'));
    }

    public function update(UpdateRequest $request, File $file, Form $form)
    {
        $this->dispatchNow($formUpdated = new Update($file, $form, $request->all()));

        flash_success(__('app.itemUpdated', ['itemName' => $form->name]));

        if ($return = $request->get('return')) {
            return redirect($return);
        }

        return redirect()->route('files.show', [$file]);
    }
}
