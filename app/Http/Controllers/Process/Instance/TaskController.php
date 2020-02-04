<?php

namespace App\Http\Controllers\Process\Instance;

use App\Http\Controllers\Controller;
use App\Process\Instance;
use App\Process\Instance\Task;
use Illuminate\Http\Request;

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
        $tasks = $instance->tasks;

        return $this->view('processes.tasks.index', compact('instance', 'tasks'));
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
        return $this->view('processes.tasks.show', compact('instance', 'task'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process\Instance $instance
     * @param  \App\Process\Instance\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instance $instance, Task $task)
    {
        //
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
