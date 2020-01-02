<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\Store as StoreRequest;
use App\Http\Requests\Admin\User\Update as UpdateRequest;
use App\Jobs\User\Create;
use App\Jobs\User\Update;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        $users->load('headshots');

        return $this->view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $user->active = true;
        $user->timezone = $request->user()->timezone;

        return $this->view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($userCreated = new Create(
            $request->name,
            $request->email,
            $request->timezone,
            $request->job_title,
            $request->password,
            $request->has('active'),
            $request->has('administrator'),
            $request->has('system_administrator')
        ));

        $user = $userCreated->getUser();

        \App\flash_success(__('admin.user_created'));

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $this->view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $this->dispatchNow($userUpdated = new Update(
            $user,
            $request->name,
            $request->email,
            $request->timezone,
            $request->job_title,
            $request->has('active'),
            $request->has('administrator'),
            $request->has('system_administrator'),
            $request->password ?? ''
        ));

        \App\flash_success(__('admin.user_updated'));

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
