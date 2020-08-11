<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\AccessLock;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileType\AccessLocks\Store as StoreRequest;
use App\Http\Requests\Admin\FileType\AccessLocks\Update as UpdateRequest;
use App\Jobs\FileType\AccessLock\Create;
use App\Jobs\FileType\AccessLock\Update;
use Illuminate\Http\Request;
use function App\flash_success;

class AccessLockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType)
    {
        return $this->view('admin.file-types.access-locks.index', compact(
            'fileType'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType)
    {
        $accessLock = new AccessLock();
        $accessLock->file_type_id = $fileType->id;

        return $this->view('admin.file-types.access-locks.create', compact(
            'fileType',
            'accessLock'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @param  FileType $fileType
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, FileType $fileType)
    {
        $this->dispatchNow($accessLockCreated = new Create($fileType, $request->name, $request->details));

        $accessLock = $accessLockCreated->getAccessLock();

        flash_success(__('admin.accessLock_created'));

        return redirect($request->return);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType\AccessLock  $accessLock
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, AccessLock $accessLock)
    {
        return $this->view('admin.file-types.access-locks.show', compact('fileType', 'accessLock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType\AccessLock  $accessLock
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, AccessLock $accessLock)
    {
        return $this->view('admin.file-types.access-locks.edit', compact('fileType', 'accessLock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param FileType $fileType
     * @param  \App\FileType\AccessLock  $accessLock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FileType $fileType, AccessLock $accessLock)
    {
        $this->dispatchNow($accessLockUpdated = new Update($accessLock, $request->name, $request->details));

        flash_success(__('admin.accessLock_updated'));

        return redirect($request->return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType\AccessLock  $accessLock
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, AccessLock $accessLock)
    {
        //
    }
}
