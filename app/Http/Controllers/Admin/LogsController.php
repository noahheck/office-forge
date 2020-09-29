<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Logs\FileList;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index(FileList $fileList)
    {
        $logFiles = $fileList->getLogFilesList();

        return $this->view('admin.logs.index', compact('logFiles'));
    }

    public function show($logFile, Factory $diskFactory, FileList $fileList)
    {
        $logFiles = $fileList->getLogFilesList();

        abort_unless($logFiles->contains($logFile), 404);

        $disk = $diskFactory->disk('logs');

        $logFileContent = $disk->get($logFile);

        return $this->view('admin.logs.show', compact('logFile', 'logFileContent'));
    }
}
