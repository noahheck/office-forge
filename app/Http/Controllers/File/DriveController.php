<?php

namespace App\Http\Controllers\File;

use App\File;
use App\FileStore\Drive;
use App\Http\Controllers\Controller;
use App\Http\Requests\Drive\UploadFiles as UploadFilesRequest;
use App\Jobs\FileStore\Drive\MediaFile\Create;
use App\Utility\FilenameParser;
use Illuminate\Http\Request;
use function App\flash_success;

class DriveController extends Controller
{

    /**
     * Routes file specifies the can:view,file middleware for this Controller file, so no need to verify user can view
     * the file
     */

    public function index(Request $request, File $file)
    {
        $user = $request->user();

        $fileType = $file->fileType;

        $drives = $fileType->drives->filter(function($drive) use ($user) {

            return $user->can('view', $drive);
        });

        return $this->view('files.drives.index', compact('file', 'fileType', 'drives'));
    }

    public function show(Request $request, File $file, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);
        abort_unless($drive->file_type_id === $file->file_type_id, 404);

        $fileType = $file->fileType;

        $drive->load('topLevelFolders');
        $drive->load(
            'topLevelMediaFiles',
            'topLevelMediaFiles.headshots',
            'topLevelMediaFiles.drive',
            'topLevelMediaFiles.drive.teams'
        );

        return $this->view('files.drives.show', compact('file', 'fileType', 'drive'));
    }

    public function uploadFiles(UploadFilesRequest $request, File $file, Drive $drive, FilenameParser $filenameParser)
    {
        abort_unless($request->user()->can('editContents', $drive), 403);
        abort_unless($drive->file_type_id === $file->file_type_id, 404);

        $count = 0;
        foreach ($request->file('files') as $mediaFile) {

            $filename = $filenameParser->parseFilenameParts($mediaFile->getClientOriginalName())['filename'];

            $this->dispatchNow($mediaFileCreated = new Create(
                $drive,
                $request->folder_id,
                $mediaFile,
                $filename,
                '',
                $request->user(),
                $file->id
            ));

            $count++;
        }

        flash_success(trans_choice('fileStore.files_uploaded', $count, ['count' => $count]));

        return redirect($request->return);
    }
}
