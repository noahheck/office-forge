<?php

namespace App\Http\Controllers;

use App\FileStore\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $drives = Drive::ordered()->get();

        $drives = $drives->filter(function($drive) use ($user) {
            return $user->can('view', $drive);
        });

        return $this->view('drives.index', compact('drives'));
    }

    public function show(Request $request, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);

         $drive->load('topLevelFolders');
         $drive->load('topLevelMediaFiles');

        return $this->view('drives.show', compact('drive'));
    }
}
