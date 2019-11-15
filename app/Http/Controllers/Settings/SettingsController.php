<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Settings\Update as UpdateRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return $this->view('settings.index', [
            'user' => $request->user(),
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $user = $request->user();

        $user->fill($request->only($user->getFillable()));

        $user->save();

        return redirect()->route('my-settings.index');
    }
}
