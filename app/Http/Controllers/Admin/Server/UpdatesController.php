<?php

namespace App\Http\Controllers\Admin\Server;

use App\Http\Controllers\Controller;
use App\Jobs\Server\Updates\SaveSettings;
use App\Options;
use App\Server\Updates;
use App\Server\Updates\Update;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Server\Updates\SaveSettingsRequest;
use function App\flash_success;

class UpdatesController extends Controller
{
    public function settings(Request $request, Options $options)
    {
        $schedule = $options->get(Updates::SCHEDULE_OPTION);
        $time = $options->get(Updates::TIME_OPTION);

        return $this->view('admin.server.updates.settings', compact('schedule', 'time'));
    }

    public function saveSettings(SaveSettingsRequest $request)
    {
        $this->dispatchNow($settingsSaved = new SaveSettings($request->schedule, $request->time));

        flash_success(__('admin.server_updateSettings_saved'));

        return redirect()->route('admin.server');
    }


    public function history()
    {
        $updates = Update::orderBy('created_at', 'DESC')->get();

        return $this->view('admin.server.updates.history', compact('updates'));
    }

    public function update(Update $update)
    {
        return $this->view('admin.server.updates.update', compact('update'));
    }
}
