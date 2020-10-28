<?php

namespace App\Http\Controllers\File\Drive;

use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\FileStore\MediaFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Drive\File\Store as StoreRequest;
use App\Http\Requests\Drive\File\Update as UpdateRequest;
use App\Jobs\FileStore\Drive\MediaFile\Create;
use App\Jobs\FileStore\Drive\MediaFile\Update;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use function App\flash_info;
use function App\flash_success;


class MediaFileController extends Controller
{

    /**
     * Routes file specifies the can:view,file middleware for this Controller file, so no need to verify user can view
     * the file
     */

    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Drive $drive
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, File $file, Drive $drive)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($request->user()->can('view', $drive), 403);

        $fileType = $file->fileType;

        return $this->view('files.drives.media-files.index', compact('file', 'fileType', 'drive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Drive $drive
     * @return void
     */
    public function create(Request $request, File $file, Drive $drive)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($user->can('view', $drive), 403);

        if ($folder_id = $request->query('folder_id')) {
            $folder = Folder::find($folder_id);
            abort_unless($drive->id === $folder->drive_id, 404);
        }

        $fileType = $file->fileType;

        $mediaFile = new MediaFile;
        $mediaFile->drive_id = $drive->id;
        $mediaFile->file_id = $file->id;
        $mediaFile->folder_id = $folder_id;
        $mediaFile->uploaded_by = $user->id;

        return $this->view('files.drives.media-files.create', compact('file', 'fileType', 'drive', 'mediaFile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @return void
     */
    public function store(StoreRequest $request, File $file, Drive $drive)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($user->can('view', $drive), 403);

        if ($folder_id = $request->folder_id) {
            $folder = Folder::find($folder_id);
            abort_unless($drive->id === $folder->drive_id, 404);
        }

        $this->dispatchNow($mediaFileCreated = new Create(
            $drive,
            $request->folder_id,
            $request->file,
            $request->name,
            $request->description,
            $request->user(),
            $file->id
        ));

        flash_success(__('fileStore.file_uploaded'));

        $mediaFile = $mediaFileCreated->getMediaFile();

        if (!$return = $request->return) {
            $return = route('files.drives.files.show', [$file, $drive, $mediaFile]);
        }

        return redirect($return);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, File $file, Drive $drive, MediaFile $mediaFile)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($drive->id === $mediaFile->drive_id, 404);
        abort_unless($file->id === $mediaFile->file_id, 404);
        abort_unless($user->can('view', $mediaFile), 403);

        $fileType = $file->fileType;

        return $this->view('files.drives.media-files.show', compact('file', 'fileType', 'drive', 'mediaFile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, File $file, Drive $drive, MediaFile $mediaFile)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($drive->id === $mediaFile->drive_id, 404);
        abort_unless($file->id === $mediaFile->file_id, 404);
        abort_unless($user->can('update', $mediaFile), 403);

        $fileType = $file->fileType;

        return $this->view('files.drives.media-files.edit', compact('file', 'fileType', 'drive', 'mediaFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, File $file, Drive $drive, MediaFile $mediaFile)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($drive->id === $mediaFile->drive_id, 404);
        abort_unless($file->id === $mediaFile->file_id, 404);
        abort_unless($user->can('update', $mediaFile), 403);

        $this->dispatchNow($mediaFileUpdated = new Update($mediaFile, $request->name, $request->description));

        flash_success(__('fileStore.file_updated'));

        if (!$return = $request->return) {
            $return = route('files.drives.files.show', [$file, $drive, $mediaFile]);
        }

        return redirect($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function destroy(Request $request, File $file, Drive $drive, MediaFile $mediaFile)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($drive->id === $mediaFile->drive_id, 404);
        abort_unless($file->id === $mediaFile->file_id, 404);
        abort_unless($user->can('delete', $mediaFile), 403);

        $folder = $mediaFile->folder;

        $mediaFile->delete();

        flash_info(__('fileStore.file_deleted'));

        if ($folder) {
            return redirect()->route('files.drives.folders.show', [$file, $drive, $folder]);
        }

        return redirect()->route('files,drives.show', [$file, $drive]);
    }


    public function preview(Request $request, File $file, Drive $drive, MediaFile $mediaFile, $filename)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($drive->id == $mediaFile->drive_id, 404, 'Drive ids mismatch');
        abort_unless($file->id === $mediaFile->file_id, 404);
        abort_unless($user->can('view', $mediaFile), 403);

        return response()->file($this->filesystem->path('/media-files/' . $mediaFile->filename), [
                'Content-Disposition' => 'inline',
            ])
            ->setLastModified($mediaFile->updated_at);
    }

    public function downloadFile(Request $request, File $file, Drive $drive, MediaFile $mediaFile, $filename)
    {
        $user = $request->user();
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($drive->id == $mediaFile->drive_id, 404, 'Drive ids mismatch');
        abort_unless($file->id === $mediaFile->file_id, 404);
        abort_unless($user->can('view', $mediaFile), 403);

        return response()->file($this->filesystem->path('/media-files/' . $mediaFile->filename), [
                'Content-Disposition' => 'attachment; filename="' . $mediaFile->name . '"',
            ])
            ->setLastModified($mediaFile->updated_at);
    }
}
