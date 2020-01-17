<?php

namespace App\Http\Controllers\Admin\Process;

use App\Http\Controllers\Controller;
use App\Process;
use App\Process\Task;

use App\Http\Requests\Admin\Process\Task\Store as StoreRequest;
use App\Http\Requests\Admin\Process\Task\Update as UpdateRequest;

use App\Jobs\Process\Task\Create;
use App\Jobs\Process\Task\Update;

use function App\flash_success;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Process $process)
    {
        $process->load('tasks', 'tasks.actions');

        return $this->view('admin.processes.tasks.index', compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Process $process)
    {
        $task = new Task;
        $task->active = true;

        return $this->view('admin.processes.tasks.create', compact('process', 'task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Process $process)
    {
        $this->dispatchNow($taskCreated = new Create(
            $process,
            $request->name,
            $request->details,
            $request->temp_id
        ));

        flash_success(__('admin.task_created'));

        if ($return = $request->query('return')) {
            return redirect($return);
        }

        return redirect()->route('admin.processes.show', [$process]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process, Task $task)
    {
        return $this->view('admin.processes.tasks.show', compact('process', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process, Task $task)
    {
        return $this->view('admin.processes.tasks.edit', compact('process', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Process $process, Task $task)
    {
        $this->dispatchNow($taskUpdated = new Update(
            $process,
            $task,
            $request->name,
            $request->has('active'),
            $request->details
        ));

        flash_success(__('admin.task_updated'));

        if ($return = $request->query('return')) {
            return redirect($return);
        }

        return redirect()->route('admin.processes.show', [$process]);
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
