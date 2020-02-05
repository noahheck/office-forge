<?php

namespace App\Http\Controllers\Process\Instance\Task;

use App\Process\Instance;
use App\Process\Instance\Task;
use App\Process\Instance\Task\Action;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Instance $instance
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function index(Instance $instance, Task $task)
    {
        $task->load(['actions']);

        return $this->view('processes.tasks.actions.index', compact('instance', 'task'));
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
     * @param Instance $instance
     * @param Task $task
     * @param  \App\Process\Instance\Task\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instance, Task $task, Action $action)
    {
        return $this->view('processes.tasks.actions.show', compact('instance', 'task', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Instance $instance
     * @param Task $task
     * @param  \App\Process\Instance\Task\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instance, Task $task, Action $action)
    {
        return $this->view('processes.tasks.actions.edit', compact('instance', 'task', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Instance $instance
     * @param Task $task
     * @param  \App\Process\Instance\Task\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instance $instance, Task $task, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Instance $instance
     * @param Task $task
     * @param  \App\Process\Instance\Task\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance, Task $task, Action $action)
    {
        //
    }
}
