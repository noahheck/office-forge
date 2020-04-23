<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use function App\flash_error;

class MyFilesController extends Controller
{
    public function addToMyFiles(Request $request, File $file)
    {
        $user = $request->user();

        if (!$user->can('view', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('home');
        }

        $user->myFiles()->attach($file);

        return redirect(url()->previous());
    }

    public function removeFromMyFiles(Request $request, File $file)
    {
        $request->user()->myFiles()->detach($file);

        return redirect(url()->previous());
    }
}
