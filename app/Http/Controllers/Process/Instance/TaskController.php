<?php

namespace App\Http\Controllers\Process\Instance;

use App\Http\Controllers\Controller;
use App\Jobs\Process\Instance\Task\Update;
use App\Process\Instance;
use App\Process\Instance\Task;
use Illuminate\Http\Request;
use App\Http\Requests\Process\Task\Update as UpdateRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Process\Instance $instance
     * @return \Illuminate\Http\Response
     */
    public function index(Instance $instance)
    {
        $process = $instance->process;
        $tasks = $instance->tasks;

        return $this->view('processes.tasks.index', compact('process', 'instance', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        //
    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Process\Instance $instance
     * @param  \App\Process\Instance\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instance, Task $task)
    {
        $process = $instance->process;

        return $this->view('processes.tasks.show', compact('process', 'instance', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process\Instance $instance
     * @param  \App\Process\Instance\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instance, Task $task)
    {
        $process = $instance->process;
        return $this->view('processes.tasks.edit', compact('process', 'instance', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process\Instance $instance
     * @param  \App\Process\Instance\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Instance $instance, Task $task)
    {
        $this->dispatchNow($taskUpdated = new Update(
            $task,
            $request->has('completed'),
            $request->details
        ));

        \App\flash_success(__('process.task_taskUpdated'));

        if ($request->return) {
            return redirect($request->return);
        }

        return redirect()->route('processes.show', [$instance]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process\Instance $instance
     * @param  \App\Process\Instance\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance, Task $task)
    {
        //
    }
}
