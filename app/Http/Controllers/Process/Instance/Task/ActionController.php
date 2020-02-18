<?php

namespace App\Http\Controllers\Process\Instance\Task;

use App\Jobs\Process\Instance\Task\Action\Complete;
use App\Jobs\Process\Instance\Task\Action\Uncomplete;
use App\Jobs\Process\Instance\Task\Action\Update;
use App\Process\Instance;
use App\Process\Instance\Task;
use App\Process\Instance\Task\Action;
use App\Http\Controllers\Controller;
use App\Http\Requests\Process\Task\Action\Update as UpdateRequest;
use Illuminate\Http\Request;
use function App\flash_success;

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
        $process = $instance->process;

        $task->load(['actions']);

        return $this->view('processes.tasks.actions.index', compact('process', 'instance', 'task'));
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
        $process = $instance->process;

        return $this->view('processes.tasks.actions.show', compact('process', 'instance', 'task', 'action'));
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
        $process = $instance->process;

        return $this->view('processes.tasks.actions.edit', compact('process', 'instance', 'task', 'action'));
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
    public function update(UpdateRequest $request, Instance $instance, Task $task, Action $action)
    {
        $this->dispatchNow($actionUpdated = new Update(
            $action,
            $request->has('completed'),
            $request->details
        ));

        \App\flash_success(__('process.action_actionUpdated'));

        if ($request->return) {
            return redirect($request->return);
        }

        return redirect()->route('processes.show', [$instance]);
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


    public function complete(Request $request, Instance $instance, Task $task, Action $action)
    {
        $this->dispatchNow($actionCompleted = new Complete($action));

        flash_success(__('process.action_actionUpdated'));

        if ($return = $request->return) {
            return redirect($return);
        }

        return redirect()->route('processes.show', [$instance]);
    }

    public function uncomplete(Request $request, Instance $instance, Task $task, Action $action)
    {
        $this->dispatchNow($actionCompleted = new Uncomplete($action));

        flash_success(__('process.action_actionUpdated'));

        if ($return = $request->return) {
            return redirect($return);
        }

        return redirect()->route('processes.show', [$instance]);
    }
}
