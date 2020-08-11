<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\AccessLock;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessLockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FileType $fileType)
    {
        //
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
