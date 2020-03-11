<?php

namespace App\Http\Controllers\File;

use App\File;
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
}
