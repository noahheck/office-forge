<?php

namespace App\Http\Controllers\Drive;

use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Drive\File\Store as StoreRequest;
use App\Jobs\FileStore\Drive\MediaFile\Create;
use Illuminate\Http\Request;
use function App\flash_success;

class MediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Drive $drive
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);

        return $this->view('drives.media-files.index', compact('drive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Drive $drive
     * @return void
     */
    public function create(Request $request, Drive $drive)
    {
        $user = $request->user();
        abort_unless($user->can('view', $drive), 403);

        $mediaFile = new MediaFile;
        $mediaFile->drive_id = $drive->id;
        $mediaFile->folder_id = $request->query('folder_id');
        $mediaFile->uploaded_by = $user->id;

        return $this->view('drives.media-files.create', compact('drive', 'mediaFile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @return void
     */
    public function store(StoreRequest $request, Drive $drive)
    {
        $this->dispatchNow($mediaFileCreated = new Create(
            $drive,
            $request->folder_id,
            $request->file,
            $request->name,
            $request->description,
            $request->user()
        ));

        flash_success(__('fileStore.file_uploaded'));

        $mediaFile = $mediaFileCreated->getMediaFile();

        if (!$return = $request->return) {
            $return = route('drives.files.show', [$drive, $mediaFile]);
        }

        return redirect($return);
    }

    /**
     * Display the specified resource.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function show(Drive $drive, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function edit(Drive $drive, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function update(Request $request, Drive $drive, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function destroy(Drive $drive, MediaFile $mediaFile)
    {
        //
    }
}
