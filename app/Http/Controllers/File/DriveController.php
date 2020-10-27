<?php

namespace App\Http\Controllers\File;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriveController extends Controller
{
    public function index(Request $request, File $file)
    {
        $user = $request->user();

        $fileType = $file->fileType;

        $drives = $fileType->drives->filter(function($drive) use ($user) {
            return $user->can('view', $drive);
        });

        return $this->view('files.drives.index', compact('file', 'fileType', 'drives'));
    }
}
