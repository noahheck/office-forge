<?php

namespace App\Http\Controllers\Drive;

use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Drive\Folders\Store as StoreRequest;
use App\Http\Requests\Drive\Folders\Update as UpdateRequest;
use App\Jobs\FileStore\Drive\Folder\Create;
use App\Jobs\FileStore\Drive\Folder\Update;
use Illuminate\Http\Request;
use function App\flash_success;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);

        return $this->view('drives.folders.index', compact('drive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);

        $folder = new Folder;

        $folder->drive_id = $drive->id;
        $folder->parent_folder_id = $request->query('parent_folder_id');

        return $this->view('drives.folders.create', compact('folder', 'drive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Drive $drive)
    {
        $this->dispatchNow($folderCreated = new Create(
            $drive,
            $request->name,
            $request->description,
            $request->parent_folder_id
        ));

        flash_success(__('fileStore.folder_created'));

        $folder = $folderCreated->getFolder();

        return redirect()->route('drives.folders.show', [$drive, $folder]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Drive $drive, Folder $folder)
    {
        abort_unless($request->user()->can('view', $drive), 403);

        $folder->load('mediaFiles', 'mediaFiles.headshots', 'mediaFiles.drive', 'mediaFiles.drive.teams');

        return $this->view('drives.folders.show', compact('drive', 'folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Drive $drive, Folder $folder)
    {
        abort_unless($request->user()->can('view', $drive), 403);

        return $this->view('drives.folders.edit', compact('drive', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Drive $drive, Folder $folder)
    {
        $this->dispatchNow($folderUpdated = new Update($folder, $request->name, $request->description));

        flash_success(__('fileStore.folder_updated'));

        return redirect()->route('drives.folders.show', [$drive, $folder]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drive $drive, Folder $folder)
    {
        //
    }
}
