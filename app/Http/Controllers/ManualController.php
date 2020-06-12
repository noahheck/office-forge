<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index(Request $request, $key = null)
    {
        if ($key && !view()->exists("manual.en.{$key}")) {

            abort(404);
        }

        $key = $key ?? 'home';

        return view('manual.manual', [
            'key' => $key,
        ]);
    }
}
