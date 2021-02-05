<?php

namespace App\Http\Controllers;

use App\Jobs\ResourceFile\Create;
use App\ResourceFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use function App\flash_success;

class ResourceFileController extends Controller
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function uploadFiles(Request $request)
    {
        $resource_type = $request->resource_type;
        $resource_id = $request->resource_id;

        $resource = $resource_type::find($resource_id);

        abort_unless($resource, 404);
        abort_unless($request->user()->can('update', $resource), 403);

        $count = 0;

        foreach ($request->file('files') as $file) {
            $this->dispatchNow($resourceFileCreated = new Create(
                $resource_type,
                $resource_id,
                $file,
                $request->user()
            ));

            $count++;
        }

        flash_success(trans_choice('fileStore.files_uploaded', $count, ['count' => $count]));

        return redirect($request->return);
    }









    public function preview(Request $request, ResourceFile $resourceFile, $filename)
    {
        $user = $request->user();
        $resource = $resourceFile->resource;

        abort_unless($user->can('view', $resource), 403);

        return response()->file($this->filesystem->path('/resource-files/' . $resourceFile->filename), [
            'Content-Disposition' => 'inline',
        ])
            ->setLastModified($resourceFile->updated_at);
    }

    public function downloadFile(Request $request, ResourceFile $resourceFile, $filename)
    {
        $user = $request->user();
        $resource = $resourceFile->resource;

        abort_unless($user->can('view', $resource), 403);

        return response()->file($this->filesystem->path('/resource-files/' . $resourceFile->filename), [
            'Content-Disposition' => 'attachment; filename="' . $resourceFile->name . '"',
        ])
            ->setLastModified($resourceFile->updated_at);
    }

}
