<?php

namespace App\Http\Controllers\Admin;

use App\FileStore\Drive;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Drives\Store as StoreRequest;
use App\Http\Requests\Admin\Drives\Update as UpdateRequest;
use App\Jobs\FileStore\Drive\Create;
use App\Jobs\FileStore\Drive\Update;
use App\Team;
use Illuminate\Http\Request;
use function App\flash_success;

class DriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drives = Drive::ordered()->get();

        $drives->load('teams');

        return $this->view('admin.drives.index', compact('drives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drive = new Drive();

        $teamOptions = Team::orderBy('name')->get();

        return $this->view('admin.drives.create', compact('drive', 'teamOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($driveCreated = new Create(
            $request->name,
            $request->description,
            $request->teams
        ));

        $drive = $driveCreated->getDrive();

        flash_success(__('admin.'));

        return redirect()->route('admin.drives.show', [$drive]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileStore\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function show(Drive $drive)
    {
        return $this->view('admin.drives.show', compact('drive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileStore\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function edit(Drive $drive)
    {
        $teamOptions = Team::orderBy('name')->get();

        return $this->view('admin.drives.edit', compact('drive', 'teamOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileStore\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Drive $drive)
    {
        $this->dispatchNow($driveUpdated = new Update(
            $drive,
            $request->name,
            $request->description,
            $request->teams
        ));

        flash_success(__('admin.drive_updated'));

        return redirect()->route('admin.drives.show', [$drive]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileStore\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drive $drive)
    {
        //
    }
}
