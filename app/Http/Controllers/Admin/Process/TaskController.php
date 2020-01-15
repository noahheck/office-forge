<?php

namespace App\Http\Controllers\Admin\Process;

use App\Http\Controllers\Controller;
use App\Process;
use App\Process\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Process $process)
    {
        return $this->view('admin.processes.tasks.index', compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Process $process)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Process $process)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process, Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process, Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Process $process, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process, Task $task)
    {
        //
    }
}
