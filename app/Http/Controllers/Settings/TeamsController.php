<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $teams = $user->teams;

        return $this->view('settings.teams', [
            'user' => $user,
            'teams' => $teams,
        ]);
    }
}
