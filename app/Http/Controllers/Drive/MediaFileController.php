<?php

namespace App\Http\Controllers\Drive;

use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\FileStore\MediaFile\Version;
use App\Http\Controllers\Controller;
use App\Http\Requests\Drive\File\NewVersion as NewVersionRequest;
use App\Http\Requests\Drive\File\Store as StoreRequest;
use App\Http\Requests\Drive\File\Update as UpdateRequest;
use App\Jobs\FileStore\Drive\MediaFile\AddNewVersion;
use App\Jobs\FileStore\Drive\MediaFile\Create;
use App\Jobs\FileStore\Drive\MediaFile\Update;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use function App\flash_info;
use function App\flash_success;


class MediaFileController extends Controller
{
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
    public function index(Request $request, Drive $drive)
    {
        abort_unless(is_null($drive->file_type_id), 404);
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
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($user->can('editContents', $drive), 403);

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
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($user->can('editContents', $drive), 403);

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
     * @param Request $request
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('view', $file), 403);

        $mediaFile = $file;

        return $this->view('drives.media-files.show', compact('drive', 'mediaFile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 400);
        abort_unless($user->can('update', $file), 403);

        $mediaFile = $file;

        return $this->view('drives.media-files.edit', compact('drive', 'mediaFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 400);
        abort_unless($user->can('update', $file), 403);

        $this->dispatchNow($mediaFileUpdated = new Update($file, $request->name, $request->description));

        flash_success(__('fileStore.file_updated'));

        if (!$return = $request->return) {
            $return = route('drives.files.show', [$drive, $file]);
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
    public function destroy(Request $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('delete', $file), 403);

        $folder = $file->folder;

        $file->delete();

        flash_info(__('fileStore.file_deleted'));

        if ($folder) {
            return redirect()->route('drives.folders.show', [$drive, $folder]);
        }

        return redirect()->route('drives.show', [$drive]);
    }


    public function allVersions(Request $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('view', $file), 403);

        $mediaFile = $file;

        $versions = $mediaFile->versions;

        return $this->view('drives.media-files.versions', compact('drive', 'mediaFile', 'versions'));
    }


    public function newVersion(Request $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('update', $file), 403);

        $mediaFile = $file;

        return $this->view('drives.media-files.new-version', compact('drive', 'mediaFile'));
    }

    public function uploadNewVersion(NewVersionRequest $request, Drive $drive, MediaFile $file)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('update', $file), 403);

        $this->dispatchNow($mediaFileCreated = new AddNewVersion(
            $file,
            $request->file,
            $request->name,
            $request->description,
            $request->user()
        ));

        flash_success(__('fileStore.file_newVersionUploaded'));

        $mediaFile = $mediaFileCreated->getMediaFile();

        $return = route('drives.files.show', [$drive, $mediaFile]);

        return redirect($return);
    }




    public function preview(Request $request, Drive $drive, MediaFile $file, $filename)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('view', $file), 403);

        return response()->file($this->filesystem->path('/media-files/' . $file->filename), [
                'Content-Disposition' => 'inline',
            ])
            ->setLastModified($file->updated_at);
    }

    public function downloadFile(Request $request, Drive $drive, MediaFile $file, $filename)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('view', $file), 403);

        return response()->file($this->filesystem->path('/media-files/' . $file->filename), [
                'Content-Disposition' => 'attachment; filename="' . $file->name . '"',
            ])
            ->setLastModified($file->updated_at);
    }



    public function previewVersion(Request $request, Drive $drive, MediaFile $file, Version $version, $filename)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('view', $file), 403);

        return response()->file($this->filesystem->path('/media-files/' . $version->filename), [
            'Content-Disposition' => 'inline',
        ])
            ->setLastModified($version->updated_at);
    }

    public function downloadVersion(Request $request, Drive $drive, MediaFile $file, Version $version, $filename)
    {
        $user = $request->user();
        abort_unless(is_null($drive->file_type_id), 404);
        abort_unless($drive->id === $file->drive_id, 404);
        abort_unless($user->can('view', $file), 403);

        return $this->download($this->filesystem->path('/media-files/' . $version->filename), $version->name, [
            'Content-Disposition' => 'attachment; filename="' . $version->name . '"',
        ])
            ->setLastModified($version->updated_at);
    }
}
