<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditorImage\Upload as UploadRequest;
use App\EditorImage;
use App\Jobs\EditorImage\Upload;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EditorImageController extends Controller
{
    public function upload(UploadRequest $request)
    {
        $this->dispatchNow($imageUploaded = new Upload(
            $request->file,
            $request->resource_type,
            $request->resource_id,
            $request->resource_temp_id,
            $request->user()
        ));

        return $this->json(true, [
            'url' => route('editor-images.show', [$imageUploaded->getEditorImage()]),
        ]);
    }

    public function show(Request $request, EditorImage $editorImage, Filesystem $disk)
    {
        $resource = $editorImage->resource;

        if (method_exists($resource, 'isAccessibleBy')) {
            abort_unless($resource->isAccessibleBy($request->user()), 403);
        }

        $lastModified = new \DateTime($editorImage->updated_at);

        $response = new Response();

        $response->setLastModified($lastModified);

        if ($response->isNotModified($request)) {

            return $response;
        }

        $path = DIRECTORY_SEPARATOR . 'editor-images' . DIRECTORY_SEPARATOR;

        return response()->file($disk->path($path . $editorImage->filename))
            ->setLastModified($lastModified)
            ->setPublic();
    }

}
