<?php

namespace App\Http\Controllers\Admin;

use App\Backups;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Backups\SaveSettings as SaveSettingsRequest;
use App\Jobs\Backups\SaveSettings;
use App\Options;
use Illuminate\Http\Request;
use function App\flash_success;

class BackupsController extends Controller
{
    public function index()
    {
        return $this->view('admin.backups.index');
    }

    public function settings(Options $options)
    {
        $time = $options->get(Backups::TIME_OPTION);
        $storageTime = $options->get(Backups::STORAGE_TIME_OPTION);

        return $this->view('admin.backups.settings', compact('time', 'storageTime'));
    }

    public function saveSettings(SaveSettingsRequest $request)
    {
        $this->dispatchNow($settingsSaved = new SaveSettings($request->time, $request->storageTime));

        flash_success(__('admin.backups_settingsSaved'));

        return redirect()->route('admin.backups');
    }
}
