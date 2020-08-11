<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\AccessLock;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileType\AccessLocks\Store as StoreRequest;
use App\Jobs\FileType\AccessLock\Create;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType\AccessLock  $accessLock
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, AccessLock $accessLock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType\AccessLock  $accessLock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileType $fileType, AccessLock $accessLock)
    {
        //
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
