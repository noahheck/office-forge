<?php

namespace App\Http\Controllers;

use App\FileStore\Drive;
use App\Http\Requests\Drive\UploadFiles as UploadFilesRequest;
use App\Jobs\FileStore\Drive\MediaFile\Create;
use App\Utility\FilenameParser;
use Illuminate\Http\Request;
use function App\flash_success;

class DriveController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $drives = Drive::whereNull('file_type_id')->ordered()->get();

        $drives = $drives->filter(function($drive) use ($user) {
            return $user->can('view', $drive);
        });

        return $this->view('drives.index', compact('drives'));
    }

    public function show(Request $request, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);

         $drive->load('topLevelFolders');
         $drive->load(
             'topLevelMediaFiles',
             'topLevelMediaFiles.headshots',
             'topLevelMediaFiles.drive',
             'topLevelMediaFiles.drive.teams'
         );

        return $this->view('drives.show', compact('drive'));
    }

    public function uploadFiles(UploadFilesRequest $request, Drive $drive, FilenameParser $filenameParser)
    {
        abort_unless($request->user()->can('editContents', $drive), 403);

        $count = 0;
        foreach ($request->file('files') as $file) {

            $filename = $filenameParser->parseFilenameParts($file->getClientOriginalName())['filename'];

            $this->dispatchNow($mediaFileCreated = new Create(
                $drive,
                $request->folder_id,
                $file,
                $filename,
                '',
                $request->user()
            ));

            $count++;
        }

        flash_success(trans_choice('fileStore.files_uploaded', $count, ['count' => $count]));

        return redirect($request->return);
    }
}
