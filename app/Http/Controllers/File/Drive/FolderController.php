<?php

namespace App\Http\Controllers\File\Drive;

use App\File;
use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Drive\Folders\Store as StoreRequest;
use App\Http\Requests\Drive\Folders\Update as UpdateRequest;
use App\Jobs\FileStore\Drive\Folder\Create;
use App\Jobs\FileStore\Drive\Folder\Update;
use Illuminate\Http\Request;
use function App\flash_info;
use function App\flash_success;

class FolderController extends Controller
{

    /**
     * Routes file specifies the can:view,file middleware for this Controller file, so no need to verify user can view
     * the file
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, File $file, Drive $drive)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($request->user()->can('view', $drive), 403);

        $fileType = $file->fileType;

        return $this->view('files.drives.folders.index', compact('file', 'fileType', 'drive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, File $file, Drive $drive)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($request->user()->can('editContents', $drive), 403);

        if ($parent_folder_id = $request->query('parent_folder_id')) {
            $parentFolder = Folder::find($parent_folder_id);
            abort_unless($drive->id === $parentFolder->drive_id, 404);
        }

        $fileType = $file->fileType;

        $folder = new Folder;

        $folder->drive_id = $drive->id;
        $folder->file_id = $file->id;
        $folder->parent_folder_id = $parent_folder_id;

        return $this->view('files.drives.folders.create', compact('file', 'fileType', 'folder', 'drive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, File $file, Drive $drive)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($request->user()->can('editContents', $drive), 403);

        $this->dispatchNow($folderCreated = new Create(
            $drive,
            $request->name,
            $request->description,
            $request->parent_folder_id,
            $file->id
        ));

        flash_success(__('fileStore.folder_created'));

        $folder = $folderCreated->getFolder();

        return redirect()->route('files.drives.folders.show', [$file, $drive, $folder]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, File $file, Drive $drive, Folder $folder)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($folder->drive_id === $drive->id, 404);
        abort_unless($folder->file_id === $file->id, 404);
        abort_unless($request->user()->can('view', $drive), 403);

        $fileType = $file->fileType;

        $folder->load('mediaFiles', 'mediaFiles.headshots', 'mediaFiles.drive', 'mediaFiles.drive.teams');

        return $this->view('files.drives.folders.show', compact('file', 'fileType', 'drive', 'folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, File $file, Drive $drive, Folder $folder)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($folder->drive_id === $drive->id, 404);
        abort_unless($folder->file_id === $file->id, 404);
        abort_unless($request->user()->can('editContents', $drive), 403);

        $fileType = $file->fileType;

        return $this->view('files.drives.folders.edit', compact('file', 'fileType', 'drive', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, File $file, Drive $drive, Folder $folder)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($folder->drive_id === $drive->id, 404);
        abort_unless($folder->file_id === $file->id, 404);
        abort_unless($request->user()->can('editContents', $drive), 403);

        $this->dispatchNow($folderUpdated = new Update($folder, $request->name, $request->description));

        flash_success(__('fileStore.folder_updated'));

        return redirect()->route('files.drives.folders.show', [$file, $drive, $folder]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, File $file, Drive $drive, Folder $folder)
    {
        abort_unless($drive->file_type_id === $file->file_type_id, 404);
        abort_unless($folder->drive_id === $drive->id, 404);
        abort_unless($folder->file_id === $file->id, 404);
        abort_unless($request->user()->can('delete', $folder), 403);

        $parentFolder = $folder->parentFolder;

        $folder->delete();

        flash_info(__('fileStore.folder_deleted'));

        if ($parentFolder) {

            return redirect()->route('files.drives.folders.show', [$file, $drive, $parentFolder]);
        }

        return redirect()->route('files.drives.show', [$file, $drive]);
    }
}
