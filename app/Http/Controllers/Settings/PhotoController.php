<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Photo\Update as UpdateRequest;
use App\Jobs\Headshottable\Upload;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        return $this->view('settings.photo', [
            'user' => $request->user(),
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $user = $request->user();

        $uploadedPhoto = $request->file('new_profile_photo');

        $this->dispatchNow($headShotUploaded = new Upload($user, $uploadedPhoto, $user));

        return redirect()->route('my-settings.photo');
    }
}
