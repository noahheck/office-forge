<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\Process\Create;
use App\Jobs\Process\Update;
use App\Process;
use App\Team;
use App\Http\Requests\Admin\Process\Store as StoreRequest;
use App\Http\Requests\Admin\Process\Update as UpdateRequest;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::orderBy('name')->get();

        return $this->view('admin.processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $process = new Process();
        $process->active = true;

        $teamOptions = Team::orderBy('name')->get();

        return $this->view('admin.processes.create', compact('process', 'teamOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($processCreated = new Create(
            $request->name,
            $request->has('active'),
            $request->details,
            $request->teams,
            $request->temp_id
        ));

        $process = $processCreated->getProcess();

        \App\flash_success(__('admin.process_created'));

        return redirect()->route('admin.processes.show', [$process]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {

        return $this->view('admin.processes.show', compact('process'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        $teamOptions = Team::orderBy('name')->get();

        return $this->view('admin.processes.edit', compact('process', 'teamOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Process $process)
    {
        $this->dispatchNow($processUpdated = new Update(
            $process,
            $request->name,
            $request->has('active'),
            $request->details,
            $request->teams
        ));

        \App\flash_success(__('admin.process_updated'));

        return redirect()->route('admin.processes.show', [$process]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        //
    }
}
