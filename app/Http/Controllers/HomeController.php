<?php

namespace App\Http\Controllers;

use App\Process;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $activities = $user->openActivities;
        $activities->load('tasks');

        $processOptions = Process::where('file_type_id', null)->get();

        return $this->view('home', compact('activities', 'user', 'processOptions'));
    }
}
