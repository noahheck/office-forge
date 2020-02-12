<?php

namespace App\Http\Controllers\Process;

use App\Jobs\Process\Instance\Create;
use App\Jobs\Process\Instance\Update;
use App\Process;
use App\Process\Instance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Process\Store as StoreRequest;
use App\Http\Requests\Process\Update as UpdateRequest;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::where('active', true)->orderBy('name')->get();

        return $this->view('processes.index', [
            'processes' => $processes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$process_id = $request->query('process_id')) {
            return redirect()->route('processes.index');
        }

        $process = Process::find($process_id);

        if (!$process->active) {
            \App\flash_warning(__('process.inactive_cantInstantiate'));

            return redirect()->route('processes.index');
        }

        $instance = new Instance();
        $instance->process_id = $process_id;
        $instance->process_name = $process->name;
        $instance->process_details = $process->details;
        $instance->owner_id = $request->user()->id;

        $ownerOptions = $process->instantiatingMembers();

        return $this->view('processes.create', [
            'process' => $process,
            'instance' => $instance,
            'ownerOptions' => $ownerOptions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $process = Process::find($request->process_id);
        $process->load('tasks', 'tasks.actions');

        $this->dispatchNow($instanceCreated = new Create(
            Process::find($request->process_id),
            $request->name,
            $request->details,
            $request->owner_id,
            $request->temp_id,
            $request->user()
        ));

        $instance = $instanceCreated->getInstance();

        \App\flash_success($instance->fullName . ' '.  __('process.instance_opened'));

        return redirect()->route('processes.show', [$instance]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instance)
    {
        // $instance->load('tasks', 'tasks.actions');

        $process = $instance->process;

        return $this->view('processes.show', compact('instance', 'process'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instance)
    {
        $ownerOptions = $instance->process->instantiatingMembers();

        $process = $instance->process;

        return $this->view('processes.edit', compact('instance', 'process', 'ownerOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Instance $instance)
    {
        $this->dispatchNow($instanceUpdated = new Update(
            $instance,
            $request->name,
            $request->details,
            $request->owner_id
        ));

        \App\flash_success($instance->fullName . ' '.  __('process.instance_updated'));

        return redirect()->route('processes.show', [$instance]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance)
    {
        //
    }
}
