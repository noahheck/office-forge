<?php

namespace App\Http\Controllers;

use App\FormDoc\Template\TemplateProvider;
use App\MyWorkProvider;
use App\Process\ProcessProvider;
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
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        MyWorkProvider $myWorkProvider,
        TemplateProvider $templateProvider,
        ProcessProvider $processProvider
    ) {
        $user = $request->user();

        $myWork = $myWorkProvider->getMyWork($user);

        $processOptions = $processProvider->getProcessesCreatableByUser($user);

        $templates = $templateProvider->getTemplatesCreatableByUser($user);

        $myFiles = $user->myFiles;

        $myFiles->load('headshots', 'fileType');

        return $this->view('home', compact(
            'activities',
            'user',
            'processOptions',
            'myFiles',
            'myWork',
            'templates'
        ));
    }
}
