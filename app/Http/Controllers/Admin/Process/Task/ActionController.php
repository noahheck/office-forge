<?php

namespace App\Http\Controllers\Admin\Process\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Process\Task\Action\Store as StoreRequest;
use App\Http\Requests\Admin\Process\Task\Action\Update as UpdateRequest;
use App\Http\Response\AjaxResponse;
use App\Jobs\Process\Task\Action\Create;
use App\Jobs\Process\Task\Action\Update;
use App\Jobs\Process\Task\Actions\UpdateOrder;
use App\Process;
use App\Process\Task;
use App\Process\Task\Action;
use Illuminate\Http\Request;

use function App\flash_success;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Process $process
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function index(Process $process, Task $task)
    {
        return $this->view('admin.processes.tasks.actions.index', compact('process', 'task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Process $process
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function create(Process $process, Task $task)
    {
        $action = new Action;

        return $this->view('admin.processes.tasks.actions.create', compact(['process', 'task', 'action']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Process $process
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Process $process, Task $task)
    {
        $this->dispatchNow($actionCreated = new Create(
            $process,
            $task,
            $request->name,
            $request->details,
            $request->temp_id
        ));


        flash_success(__('admin.action_created'));

        if ($return = $request->query('return')) {
            return redirect($return);
        }

        return redirect()->route('admin.processes.tasks.actions.show', [$process, $task]);
    }

    /**
     * Display the specified resource.
     *
     * @param Process $process
     * @param Task $task
     * @param \App\Process\Task\Action $action
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process, Task $task, Action $action)
    {
        return $this->view('admin.processes.tasks.actions.show', compact('process', 'task', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Process $process
     * @param Task $task
     * @param \App\Process\Task\Action $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process, Task $task, Action $action)
    {
        return $this->view('admin.processes.tasks.actions.edit', compact('process', 'task', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Process $process
     * @param Task $task
     * @param \App\Process\Task\Action $action
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Process $process, Task $task, Action $action)
    {
        $this->dispatchNow($actionUpdated = new Update(
            $process,
            $task,
            $action,
            $request->name,
            $request->has('active'),
            $request->details
        ));

        flash_success(__('admin.action_updated'));

        if ($return = $request->query('return')) {
            return redirect($return);
        }

        return redirect()->route('admin.processes.tasks.actions.show', [$process]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Process $process
     * @param Task $task
     * @param \App\Process\Task\Action $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process, Task $task, Action $action)
    {
        //
    }

    public function updateOrder(Request $request, Process $process, Task $task)
    {
        $this->dispatchNow($actionsOrdered = new UpdateOrder($process, $task, $request->get('orderedActions')));

        return new AjaxResponse(true, [
            'successMessage' => __('admin.actions_orderUpdated'),
        ]);
    }
}
