<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Password\Update as UpdateRequest;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;


class PasswordController extends Controller
{
    public function index()
    {
        return $this->view('settings.password', []);
    }

    public function update(UpdateRequest $request, Hasher $hasher)
    {
        $user = $request->user();

        if (!$hasher->check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->password = $hasher->make($request->new_password);

        $user->save();

        return redirect()->route('my-settings.index');
    }
}
