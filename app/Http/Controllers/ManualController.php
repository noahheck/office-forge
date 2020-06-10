<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index(Request $request, $key = null)
    {
        if ($key && !view()->exists("help.section.{$key}")) {
            abort(404);
        }

        return view('manual.en.index', [
            'key' => $key,
        ]);
    }
}
