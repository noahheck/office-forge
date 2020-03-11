<?php

namespace App\Http\Controllers\File;

use App\File;
use App\FileType\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function update(File $file, Form $form)
    {

    }
}
